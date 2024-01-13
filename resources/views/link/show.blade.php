<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Детали') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="flex flex-col md:col-span-1 justify-center items-center ml-6">
            {!! QrCode::size(300)->generate( config('app.url') . $link->slug ); !!}
            <a class="mt-5" href="{{ route('downloadQR', ['slug' => $link->slug]) }}" target="_">
              <div class="text-sm text-blue-500 hover:text-indigo-900">
                Скачать QR Code</div>
            </a>
          </div>
          <div class="md:col-span-2">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
              <div class="px-4 py-5 sm:px-6 sm:grid sm:grid-cols-2">
                <div class="sm:col-span-1">
                  <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ $link->name }}
                  </h3>
                  <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Детали
                  </p>
                </div>
                <div class="flex sm:col-span-1 justify-end items-center">
                  <a class="mr-3 delete-link" href="{{ route('deleteLink', ['slug' => $link->slug]) }}">
                    <button type="button"
                      class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      Удалить
                    </button>
                  </a>
                  <a href="{{ route('editLink', ['slug' => $link->slug]) }}">
                    <button type="button"
                      class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      Редактировать
                    </button>
                  </a>
                </div>
              </div>
              <div class="border-t border-gray-200">
                <dl>
                  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                      Имя
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                      {{ $link->name }}
                    </dd>
                  </div>
                  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                      Сокращенная ссылка
                    </dt>
                    <dd class="flex items-center space-x-3 mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                      <a href="{{config('app.url') . $link->slug }}" target="_">
                        <div class="inline text-sm text-blue-500 hover:text-indigo-900">
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
                    </dd>
                  </div>
                  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                      Исходная ссылка
                    </dt>
                    <dd class="flex items-center space-x-3 mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                      <a href="{{ $link->link }}" target="_">
                        <div class="inline text-sm text-blue-500 hover:text-indigo-900">
                          {{ $link->link }}</div>
                      </a>
                      <button class="copy-btn" data-clipboard-text="{{ $link->link }}">
                        <svg class="w-4 h-4 text-gray-700 cursor-pointer" fill="none" stroke="currentColor"
                          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                          </path>
                        </svg>
                      </button>
                    </dd>
                  </div>
                  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                      Переходов
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                      {{ $link->counter }}
                    </dd>
                  </div>
                  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                     Создан
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                      {{ $link->created_at }}
                    </dd>
                  </div>
                  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                      Статус
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                      @if ($link->status === 1)
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
                    </dd>
                  </div>
                </dl>
              </div>
            </div>
          </div>

            <div class="statistic" style="margin-top: 50px; margin-left: 50px; display: flex">
                <div class="statistic-layout" style="margin-top: 30px;display: flex;flex-direction: column;align-content: center;justify-content: center;align-items: center;">
                    <h2 style="font-size: 30px; font-weight: bold; margin-bottom: 20px" >Статистика</h2>
                    <div class="transition-layout stat-item-layout">
                        <span class="layout-text">Переходы</span>
                        <div id="transition" style="width:1100px;height:300px;">

                        </div>
                    </div>

                   <div class="statistic-row" style="display: flex; width: 1100px; margin-top: 50px; justify-content: space-between">
                       <div class="browser-layout stat-item-layout">
                           <span class="layout-text">Браузер</span>
                           <div id="browser" style="width:540px;height:300px;">

                           </div>
                       </div>
                       <div class="operationSystem-layout stat-item-layout">
                           <span class="layout-text"> Операционная система</span>
                           <div id="operationSystem" style="width:540px;height:300px;">

                           </div>
                       </div>

                   </div>


                    <div class="vmap-layout stat-item-layout" style="margin: 40px 0;">
                        <span class="layout-text">Страны</span>
                        <div id="vmap" style="width: 1100px; height: 500px;">

                        </div>

                    </div>


                </div>
            </div>



        </div>

      </div>
    </div>
  </div>

  @section('customScript')
  <script>

      let countryCodeData =   {!!  json_encode($statistic['country'])  !!};
      let countryCode = {};
      for (i = 0; i < countryCodeData.length; i++) {
          countryCode[countryCodeData[i].code.toLowerCase()] = parseInt(countryCodeData[i].count);
      }

      jQuery(document).ready(function() {
          jQuery('#vmap').vectorMap({
              map: 'world_en',
              backgroundColor: '#fff',
              borderColor: '#818181',
              borderOpacity: 0.25,
              borderWidth: 1,
              color: '#848080',
              enableZoom: true,
              hoverOpacity: 0.7,
              normalizeFunction: 'polynomial',
              scaleColors: ['#b6d6ff', '#005ace'],
              selectedColor: '#999999',
              values: countryCode,
              showTooltip: true,
              onLabelShow: function(event, label, code)
              {
                  let hasKey = (countryCode[code] !== undefined);
                  label.text(label.text() + ': ' + (hasKey ? countryCode[code] : 0));
              }
          });
      });


      let transitionData =   {!!  json_encode($statistic['transition'])  !!};
      let transitionChartX = [];
      let transitionChartY = [];
      for (i = 0; i < transitionData.length; i++) {
          transitionChartX.push(transitionData[i].date)
          transitionChartY.push(transitionData[i].count)
      }


      TESTER = document.getElementById('transition');
      Plotly.newPlot( TESTER, [{
          x: transitionChartX,
          y: transitionChartY,
          line: {'shape': 'spline', 'smoothing': 1.3}
      }],
          {
              margin: { t: 0 },
          });



      let browserData =   {!!  json_encode($statistic['browser'])  !!};
      let browserChartX = [];
      let browserChartY = [];
      for (i = 0; i < browserData.length; i++) {
          browserChartX.push(browserData[i].name)
          browserChartY.push(browserData[i].count)
      }

      var browser = [
          {
              x: browserChartX,
              y: browserChartY,
              type: 'bar'
          }
      ];

      Plotly.newPlot('browser', browser);


      let operationSystemData =   {!!  json_encode($statistic['os'])  !!};
      let operationSystemChartX = [];
      let operationSystemChartY = [];
      for (i = 0; i < operationSystemData.length; i++) {
          operationSystemChartX.push(operationSystemData[i].name)
          operationSystemChartY.push(operationSystemData[i].count)
      }

      var operationSystem = [
          {
              x: operationSystemChartX,
              y: operationSystemChartY,
              type: 'bar'
          }
      ];

      Plotly.newPlot('operationSystem', operationSystem);


    $(document).on('click', '.delete-link', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Вы уверены?',
                text: "Вы не сможете вернуть это!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Да, удалить'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace("/delete/" + {!! json_encode($link->slug) !!});
                }
            })
        });

    var clipboard = new ClipboardJS('.copy-btn');
  </script>
  @endsection
</x-app-layout>



<style>

    .jqvmap-zoomin, .jqvmap-zoomout {
        padding: 0;
        width: 20px;
        height: 20px;
        line-height: 20px;
    }

    .jqvmap-zoomout {
        top: 35px;
    }

    .stat-item-layout {
        border: 1px solid rgba(0,0,0,.125);
        box-shadow: 0 5px 20px rgba(0,0,0,.1);
    }

    .layout-text {
        display: inline-block;
       margin: 10px 0 0 10px;
    }

</style>
