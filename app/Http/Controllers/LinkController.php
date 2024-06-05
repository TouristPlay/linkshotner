<?php

namespace App\Http\Controllers;

use App\Services\StatisticService;
use Illuminate\Contracts\Foundation\Application as Application;
use Illuminate\Contracts\View\Factory as Factory;
use Illuminate\Contracts\View\View as View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Str;
use App\Models\Link as Link;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QrCode;
use RealRashid\SweetAlert\Facades\Alert as Alert;
use Illuminate\Validation\Rule as Rule;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\BinaryFileResponse as BinaryFileResponse;

class LinkController extends Controller
{
    
    public function index()
    {
        $links = Link::query()->
            where('user_id', Auth::user()->id)
            ->get();

        return view('dashboard', ['links' => $links]);
    }
    
    public function shorten()
    {
        return view('shortener', [
            'randomSlug' => Str::random(6)
        ]);
    }
    
    public function revertStatus($id): RedirectResponse
    {
        $link = Link::query()
            ->findOrFail($id);

        $link->status = !$link->status;
        $link->save();

        return back();
    }
    
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

    
    public function redirect($slug, Request $request)
    {


        $link = Link::query()
            ->where('slug', $slug)
            ->firstOrFail();

        if ($link->status === false) {
            abort(404);
        }
        
        $statisticService = new StatisticService();
        $statisticService->handle($request, $link);


        $link->increment('counter', 1);
        return redirect($link->link);
    }
}
