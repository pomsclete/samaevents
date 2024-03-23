<div>

    @include('extends.admin-side-bar')
    <main class="lg:flex">
        @include('extends.admin-aside')
        <!-- content -->
        <div class="main-content flex-grow min-h-[100%] py-20 relative px-4 lg:pr-8 lg:pl-3">
            <!-- heading -->
            <div class="flex flex-row justify-between items-center pt-2 pb-6">
               <div>
                <div class="relative w-full">
                    <button class="absolute left-1 top-1 hidden sm:inline-flex !items-center justify-center w-10 h-10 gap-x-2 p-2.5 rounded-[6.25rem] text-sm tracking-[.00714em] text-center font-medium hover:bg-primary-600/[0.08] focus:bg-primary-600/[0.08] dark:hover:bg-primary-200/[0.08] dark:focus:bg-primary-200/[0.08]">
                      <span class="material-symbols-outlined !text-2xl">search</span>
                    </button>
                    <input type="search" wire:model.live="search" placeholder="Rechercher..." 
                            wire:keydown.enter="doSomething"
                            wire:keydown.bakspace="resetValue"
                            class="max-sm:absolute max-sm:inset-x-0 block w-40 sm:w-80 md:w-full pl-14 h-12 rounded-full bg-white dark:bg-gray-900 py-2 px-4 ring-0 focus:outline-none focus:shadow">
                  </div>
              
               </div>
                
                <!-- action -->
                <div class="flex flex-row gap-3 items-center">
                    <!-- add new -->
                    <a href="{{ route('admin.addformation') }}" wire:navigate class="btn relative flex flex-row items-center justify-center gap-x-2 py-2 px-4 rounded-[6.25rem] hover:shadow-md text-sm tracking-[.00714em] font-medium bg-primary-600 text-white dark:bg-primary-200 dark:text-primary-800">
                        <span class="material-symbols-outlined">add</span>
                        Ajouter
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:gap-4 md:gap-6">
                <!-- card -->
                <div class="px-6 py-8 flex flex-col rounded-xl bg-white dark:bg-gray-900">
                    <div class="pb-4 flex justify-center">
                        <button class="btn-elevated relative inline-flex flex-row items-center justify-center gap-x-2 py-2.5 px-6 rounded-[6.25rem] shadow-lg text-md tracking-[.00714em] font-medium bg-surface-100 hover:bg-surface-200 focus:bg-surface-400 text-primary-600 dark:bg-surfacedark-100 dark:hover:bg-surfacedark-200 dark:focus:bg-surfacedark-400 dark:text-primary-200">
                            <span class="material-symbols-outlined">
                                school
                                </span> Nos formations
                          </button>
                    </div>
                    <div class="relative overflow-auto scrollbars">
                        <!-- customers table -->
                        <table class="table-sorter table-bordered-bottom table-hover">
                            <thead>
                            <tr>

                                <th style="font-weight: bold" class="cursor-pointer" wire:click="sortBy('intitule')" >Intitulé de la formation</th>
                                <th style="font-weight: bold">Dernieres modifcation</th>
                                <th style="font-weight: bold">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($records as $record)
                                 <tr class="[&amp;.selected]:!bg-primary-100 dark:[&amp;.selected]:!bg-primary-700 text-center">
                                     <td>{{$record->intitule }}</td>
                                    <td>{{ \Carbon\Carbon::parse($record->updated_at)->format('d-m-Y H:m:s') }}</td>
                                    <td>
                                        <a  href="{{ route('admin.addformation',['id' => $record->id]) }}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            <span class="material-symbols-outlined">
                                                border_color
                                                </span>
                                        </a>
                                        <button wire:click="confirmed('{{ $record->id }}')" 
                                            type="button"
                                            wire:confirm.prompt="Voulez-vous vraiment supprimer ce niveau?\n\nTaper SUPPRIMER pour confirmer|SUPPRIMER"
                                                class="ms-3 font-medium text-red-600 dark:text-red-500 hover:underline">
                                            <span class="material-symbols-outlined">
                                                delete
                                                </span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                            <tr class="[&amp;.selected]:!bg-primary-100 dark:[&amp;.selected]:!bg-primary-700 text-center">
                                <td colspan="4">
                                    <div class="flex justify-center items-center">
                                        <span class="font-medium py-8 text-gray-400 text-xl">
                                            No data found...
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="py-3">
                    {{ $records->links() }}
                </div>
            </div>
        </div>

    </main>


</div>