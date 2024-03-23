@php
  $links = [
      [
          "href" => "login",
          "text" => "Tableau de bord",
          "icon" => "<span class='material-symbols-outlined'>home</span>",
          "is_multi" => false,
      ],
       [
          "href" => [
              [
                  "section_text" => "Informations",
                  "icon" => "<span class='material-symbols-outlined'>rebase</span>",
                  "section_list" => [
                      ["href" => "login", "text" => "Actualités"],
                  ]
              ]
          ],
          "text" => "News",
          "is_multi" => true,
      ]
  ];
  $navigation_links = array_to_object($links);
@endphp

<aside id="sidebar" class="sidebar transition-all duration-500 ease-in-out fixed max-lg:z-[60] lg:shrink-0 lg:relative lg:w-72 h-screen max-lg:[&.show_.sidebar-bg]:opacity-60 dark:max-lg:[&.show_.sidebar-bg]:opacity-60 [&.show_.sidebar-bg]:inset-0 [&.show_.sidebar-content]:translate-x-0">
    <!-- backdrop -->
    <div data-close="#sidebar" class="sidebar-bg fixed z-40 opacity-0 -top-full bg-black"></div>

    <!-- menu -->
    <div id="sidebar-content" class="sidebar-content transition-all duration-300 ease-in-out fixed z-40 max-lg:-translate-x-full max-lg:bg-surface-500 dark:max-lg:bg-surfacedark-500 left-0 top-0 bottom-0 h-screen w-72 overflow-auto scrollbars">
      <!-- logo -->
      <a href="#" class="sidebar-logo pt-4 pb-2 pl-6 flex items-center w-full">
        <div class="w-9 h-9 rounded-full border-2 border-primary-600 flex items-center justify-center text-primary-800 font-bold text-lg">
          <span class="flex items-center justify-center w-6 h-6 rounded-full bg-red-400">EPF</span>
        </div>
        <h4 class="text-2xl font-medium tracking-wide text-gray-900 dark:text-gray-100 compact-hide ml-2">Online</h4>
      </a>

      <!-- Standart drawer -->
      <div class="w-full inline-flex flex-col px-3 pb-3">
        <!-- title & menu -->
        <div class="pt-6 pb-2 px-4 compact-hide">
          <p class="text-title-sm font-medium uppercase text-gray-600 dark:text-gray-400">Menu</p>
        </div>

          @foreach ($navigation_links as $link)
          <ul class="sidebar-menu flex flex-col">
              @if (!$link->is_multi)
                <li class="relative {{ Request::routeIs($link->href) ? 'active' : '' }}">
                  <a href="{{ route($link->href) }}" class="flex flex-row items-center gap-3 py-3 pl-4 pr-6 mb-1 rounded-full hover-icon [&.active]:text-gray-900 dark:[&.active]:text-gray-100 [&.active]:bg-secondary-100 dark:[&.active]:bg-secondary-700 hover:bg-primary-600/[0.08] dark:hover:bg-primary-200/[0.08]">
                    {!!  $link->icon !!}
                    <span class="compact-title">{{ $link->text }}</span>
                  </a>
                </li>
              @else
                @foreach ($link->href as $section)
                  @php
                    $routes = collect($section->section_list)->map(function ($child) {
                        return Request::routeIs($child->href);
                    })->toArray();

                    $is_active = in_array(true, $routes);
                  @endphp

                  <li class="relative {{ ($is_active) ? 'active' : '' }}">
                    <a href="javascript:void(0)" data-type="collapse" data-target="#dashboard1" class="flex flex-row items-center gap-3 py-3 pl-4 pr-6 mb-1 rounded-full hover-icon [&.active]:text-gray-900 dark:[&.active]:text-gray-100 [&.active]:bg-secondary-100 dark:[&.active]:bg-secondary-700 hover:bg-primary-600/[0.08] dark:hover:bg-primary-200/[0.08]">
                      {!!  $section->icon !!}
                      <span class="compact-title">{{ $section->section_text }}</span>
                    </a>
                    <ul id="dashboard1" data-type="collapsed" class="sidebar-submenu [&.active]:block hidden">
                      @foreach ($section->section_list as $child)
                        <li>
                          <a  href="{{ route($child->href) }}" class="flex items-center py-3 pl-12 pr-6 mb-1 leading-none gap-2.5 rounded-full hover-icon [&.active]:text-gray-900 dark:[&.active]:text-gray-100 [&.active]:bg-primary-600/[0.08] dark:[&.active]:bg-primary-200/10 hover:bg-primary-600/[0.08] dark:hover:bg-primary-200/[0.08]">
                            {{ $child->text }}
                          </a>
                        </li>
                      @endforeach
                    </ul>
                  </li>
                @endforeach
              @endif
            </ul>
          @endforeach

        <div class="w-full flex flex-col gap-2 mt-12">
          <!-- title & content -->
          <div class="pb-2 px-4 compact-hide">
            <p class="text-title-sm font-medium uppercase text-gray-600 dark:text-gray-400">Statistics</p>
          </div>
          <!-- content -->
          <div class="flex flex-col gap-4 compact-hide mb-6">
            <div class="w-full flex flex-col gap-2 px-4">
              <div class="flex flex-row justify-between">
                <span class="text-title-sm">Complete</span><span class="text-title-sm">89%</span>
              </div>
              <!-- linear progress -->
              <div class="flex bg-gray-100 dark:bg-gray-700 h-1">
                <div class="flex bg-green-600 dark:bg-green-200" role="progressbar" style="width: 89%;" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <div class="w-full flex flex-col gap-2 px-4">
              <div class="flex flex-row justify-between">
                <span class="text-title-sm">On Progress</span><span class="text-title-sm">76%</span>
              </div>
              <!-- linear progress -->
              <div class="flex bg-gray-100 dark:bg-gray-700 h-1">
                <div class="flex bg-yellow-600 dark:bg-yellow-200" role="progressbar" style="width: 76%;" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <div class="w-full flex flex-col gap-2 px-4">
              <div class="flex flex-row justify-between">
                <span class="text-title-sm">Cancelled</span><span class="text-title-sm">17%</span>
              </div>
              <!-- linear progress -->
              <div class="flex bg-gray-100 dark:bg-gray-700 h-1">
                <div class="flex bg-error-600 dark:bg-error-200" role="progressbar" style="width: 17%;" aria-valuenow="17" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>

          <!-- action -->
          <div class="px-4 flex justify-center mb-12">
            <a href="../index.html" target="_blank" class="btn relative flex flex-row items-center justify-center gap-x-2 py-2.5 px-6 rounded-[6.25rem] hover:shadow-md text-label-lg bg-primary-600 text-white dark:bg-primary-200 dark:text-primary-800">
              <span class="material-symbols-outlined">shopping_cart</span><span class="ml-1 compact-hide">Suivre la demande</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </aside>
