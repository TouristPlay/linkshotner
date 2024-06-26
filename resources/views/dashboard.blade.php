
<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between justify-items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Дашборд') }}
        </h2>

        <div>
            <form action="{{ route('dashboard') }}" method="GET" role="search">
                <div class="input-group">
                        <span class="input-group-btn mr-5 mt-1">
                            <button class="btn btn-info" type="submit" title="Поиск ссылки...">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>
                    <input type="text" class="form-control mr-1" value="{{request()->get('term')}}" name="term" placeholder="Поиск ссылки..." id="term">
                    <a href="{{ route('dashboard') }}" class=" mt-1">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button" title="Обновление страницы">
                                    <span class="fas fa-sync-alt"></span>
                                </button>
                            </span>
                    </a>
                </div>
            </form>
        </div>
    </div>

  </x-slot>

  <div class="py-9">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

        <div class="flex flex-col">
          <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
              <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Имя
                      </th>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Сокращенный URL
                      </th>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Исходный URL
                      </th>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Переходов
                      </th>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Статус
                      </th>
                      <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Пустая колонка</span>
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($links as $link)
                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $link->name }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center justify-between space-x-5">
                          <a href="{{ config('app.url') . $link->slug }}" target="_">
                            <div id="{{ $link->slug }}" class="inline text-sm text-blue-500 hover:text-indigo-900">
                              {{ config('app.url') . $link->slug }}</div>
                          </a>
                          <button class="copy-btn" data-clipboard-text="{{ config('app.url') . $link->slug }}">
                            <svg class="w-4 h-4 text-gray-700 cursor-pointer" fill="none" stroke="currentColor"
                              viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                              </path>
                            </svg>
                          </button>
                        </div>
                      </td>
                      <td class="px-6 py-4">
                        <a href="{{ $link->link }}" target="_">
                          <div class="inline text-sm text-blue-500 hover:text-indigo-900">
                              {!!\Illuminate\Support\Str::limit( $link->link, 40) !!}
                          </div>
                        </a>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $link->counter }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        @if ($link->status === true)
                        <a href="{{ route('revertStatus', ['id' => $link->id]) }}">
                          <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Активный
                          </span>
                        </a>
                        @else
                        <a href="{{ route('revertStatus', ['id' => $link->id]) }}">
                          <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Неактивный
                          </span>
                        </a>
                        @endif
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('showLink', ['slug' => $link->slug]) }}"
                          class="text-indigo-600 hover:text-indigo-900">Просмотреть</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

                @if($links->isEmpty() && request()->get('term') == null)
                <div class="flex flex-col items-center justify-center py-20 space-y-2">
                  <h1 class="text-center">Ссылки еще нет?</h1>
                  <a href="{{ route('shortener') }}">
                    <button class="w-64 bg-gray-700 p-2 rounded-md shadow-md text-white hover:bg-gray-900">
                      Создайте его здесь!
                    </button>
                  </a>
                </div>
                @endif

                  @if($links->isEmpty() && request()->get('term') != null)
                      <div class="flex flex-col items-center justify-center py-20 space-y-2">
                          <h1 class="text-center">Ссылки с названием "{{request()->get('term')}}" не найдена </h1>
                          <a href="{{ route('dashboard') }}">
                              <button class="w-64 bg-gray-700 p-2 rounded-md shadow-md text-white hover:bg-gray-900">
                                  Отчистить поиск
                              </button>
                          </a>
                      </div>
                  @endif

              </div>
            </div>
          </div>
        </div>
      </div>
        @if(!$links->isEmpty())
            <div class="flex flex-col items-center justify-center pt-4">
                {{$links->links()}}
            </div>
        @endif
    </div>
  </div>

  @section('customScript')
  <script>
    var clipboard = new ClipboardJS('.copy-btn');
  </script>
  @endsection

</x-app-layout>
