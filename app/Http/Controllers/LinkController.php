<?php

namespace App\Http\Controllers;

use App\Services\StatisticService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Link;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LinkController extends Controller
{


    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $links = Link::query()->
            where('user_id', Auth::user()->id)
            ->get();

        return view('dashboard', ['links' => $links]);
    }


    /**
     * @return Application|Factory|View
     */
    public function shorten()
    {
        return view('shortener', [
            'randomSlug' => Str::random(6)
        ]);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function revertStatus($id): RedirectResponse
    {
        $link = Link::query()
            ->findOrFail($id);

        $link->status = !$link->status;
        $link->save();

        return back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'name' => ['bail', 'required', 'string', 'max: 50'],
            'url' => ['bail', 'required', 'url'],
            'slug' => ['bail', 'required', 'string', 'max:30', 'unique:links,slug'],
        ]);

        if ($validator->fails()) {
            Alert::error('Error',  $validator->errors()->first());
            return back()->withInput();
        }

        $link = new Link;

        $link->name = $request->name;
        $link->link = $request->url;
        $link->slug = $request->slug;
        $link->user_id = Auth::check() ? Auth::id() : 1;

        $link->save();

        return redirect()->route('showLink', ['slug' => $link->slug]);
    }


    /**
     * @param $slug
     * @return BinaryFileResponse
     */
    public function downloadQR($slug): BinaryFileResponse
    {
        $dest = storage_path('app/qrCode.svg');
        $url =  config('app.url') . $slug;

        QrCode::margin(2)->size(400)->generate($url, $dest);
        return response()->download($dest);
    }


    /**
     * @param $slug
     * @return Application|Factory|View
     */
    public function edit($slug)
    {
        $link = Link::query()
            ->where('slug', $slug)
            ->where('user_id', Auth::user()->id)
            ->firstOrFail();

        return view('link.edit', ['link' => $link]);
    }

    /**
     * @param Request $request
     * @param $slug
     * @return RedirectResponse
     */
    public function update(Request $request , $slug): RedirectResponse
    {
        $link = Link::query()
            ->where('slug', $slug)
            ->where('user_id', Auth::user()->id)
            ->firstOrFail();

        $validator = Validator::make($request ->all(), [
            'name' => ['bail', 'required', 'string', 'max: 50'],
            'url' => ['bail', 'required', 'url'],
            'slug' => ['bail', 'required', 'string', 'max:30', Rule::unique('links')->ignore($link->id, 'id')],
        ]);

        if ($validator->fails()) {
            Alert::error('Error',  $validator->errors()->first());
            return back()->withInput();
        }

        $link->link = $request ->url;
        $link->slug = $request ->slug;
        $link->name = $request ->name;
        $link->status = $request ->linkStatus;

        $link->save();


        Alert::toast('Ссылк успешно обновлена', 'success');
        return redirect()->route('showLink', ['slug' => $link->slug]);
    }


    /**
     * @param $slug
     * @return RedirectResponse
     * @throws \Exception
     */
    public function delete($slug): RedirectResponse
    {
        $link = Link::query()
            ->where('slug', $slug)
            ->where('user_id', Auth::user()->id)
            ->firstOrFail();

        $link->delete();

        Alert::toast('Ссылка успешно удалена', 'error');
        return redirect()->route('dashboard');
    }


    /**
     * @param $slug
     * @return Application|Factory|View
     */
    public function show($slug)
    {

        $statisticService = new StatisticService();

        $link = Link::query()
            ->where('slug', $slug)
            ->where('user_id', Auth::user()->id)
            ->firstOrFail();

        return view('link.show', [
            'link' => $link,
            'statistic' => [
                'transition' => $statisticService->getTransitionStatistic($link->id),
                'browser' => $statisticService->getBrowserStatistic($link->id),
                'os' => $statisticService->getOperationSystemStatistic($link->id),
                'country' => $statisticService->getCountryStatistic($link->id),
            ]
        ]);
    }


    /**
     * @param $slug
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws GuzzleException
     */
    public function redirect($slug, Request $request)
    {


        $link = Link::query()
            ->where('slug', $slug)
            ->firstOrFail();

        if ($link->status === 0) {
            abort(404);
        }

        // TODO в очередь пихнуть это дело
        // TODO автоинкремент не работает
        $statisticService = new StatisticService();
        $statisticService->handle($request, $link);


        $link->increment('counter', 1);
        return redirect($link->link);
    }
}
