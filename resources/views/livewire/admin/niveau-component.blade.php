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
                    <button data-type="dialogs" wire:click="openModal()" class="btn relative flex flex-row items-center justify-center gap-x-2 py-2 px-4 rounded-[6.25rem] hover:shadow-md text-sm tracking-[.00714em] font-medium bg-primary-600 text-white dark:bg-primary-200 dark:text-primary-800">
                        <span class="material-symbols-outlined">add</span>
                        Ajouter
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:gap-4 md:gap-6">
                <!-- card -->
                <div class="px-6 py-8 flex flex-col rounded-xl bg-white dark:bg-gray-900">
                    <div class="pb-4 flex justify-center">
                        <button class="btn-elevated relative inline-flex flex-row items-center justify-center gap-x-2 py-2.5 px-6 rounded-[6.25rem] shadow-lg text-md tracking-[.00714em] font-medium bg-surface-100 hover:bg-surface-200 focus:bg-surface-400 text-primary-600 dark:bg-surfacedark-100 dark:hover:bg-surfacedark-200 dark:focus:bg-surfacedark-400 dark:text-primary-200">
                            <span class="material-symbols-outlined">
                                filter_list
                                </span> Niveaux d'étude
                          </button>
                    </div>
                    <div class="relative overflow-auto scrollbars">
                        <!-- customers table -->
                        <table class="table-sorter table-bordered-bottom table-hover">
                            <thead>
                            <tr>

                                <th style="font-weight: bold" class="cursor-pointer" wire:click="sortBy('designation')" >Désignation</th>
                                <th style="font-weight: bold">Date de création</th>
                                <th style="font-weight: bold">Dernieres modifcation</th>
                                <th style="font-weight: bold">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($records as $record)
                                 <tr class="[&amp;.selected]:!bg-primary-100 dark:[&amp;.selected]:!bg-primary-700 text-center">
                                     <td>{{$record->designation }}</td>
                                     <td>{{  \Carbon\Carbon::parse($record->created_at)->format('d-m-Y H:m:s') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($record->updated_at)->format('d-m-Y H:m:s') }}</td>
                                    <td>
                                        <button wire:click="edit('{{ $record->id }}')"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            <span class="material-symbols-outlined">
                                                border_color
                                                </span>
                                        </button>
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

    <div id="dialog_a" class="[&.show_.backDialog]:opacity-60 [&.show]:opacity-100 [&.show]:h-full [&.show]:inset-0 [&.show_.backDialog]:inset-0 duration-[400ms] ease-[cubic-bezier(0, 0, 1)] opacity-0 w-full h-0 z-50 overflow-auto fixed left-0 top-0 flex items-center justify-center {{ ($isFormOpen==true) ? 'show' : '' }}">
        <div data-close="#dialog_a" class="backDialog z-40 overflow-auto fixed bg-black"></div>

        <!-- dialogs -->
        <div class="z-50 flex flex-col w-11/12 sm:w-[480px] h-auto bg-surface-100 dark:bg-surfacedark-100 rounded-[28px]">
            <div class="flex flex-col gap-4 justify-start py-6">
                <div class="flex justify-between items-center px-6">
                    <h3 class="text-title-lg leading-7 font-normal text-gray-900 dark:text-gray-100">
                        {{ ($editModalOpen) ? "Modifier l'année scolaire" : "Ajouter une année scolaire" }}

                    </h3>

                    <!-- close -->
                    <div data-close="#dialog_a" class="material-symbols-outlined cursor-pointer">close</div>
                </div>

                <!-- Form -->
                <form class="flex flex-col gap-4 py-2 px-6 md:max-h-[45vw] overflow-auto scrollbars show">
                    <div class="relative z-0">
                        <input type="text" aria-label="deal1" wire:model="designation" id="deal1" class="w-full h-14 block leading-5 relative py-2 px-4 rounded bg-neutral-10 dark:bg-neutral-900 border focus:border-2 border-gray-500 overflow-x-auto focus:outline-none focus:border-primary-600 focus:ring-0 dark:text-gray-200 dark:border-gray-400 dark:focus:border-primary-200 peer" placeholder="1ère année"  required>

                        <label for="deal1" class="absolute tracking-[.03125em] text-gray-500 dark:text-gray-400 bg-neutral-10 dark:bg-neutral-900 duration-300 transform px-1 -translate-y-7 scale-75 top-4 z-10 origin-[0] left-4 peer-focus:left-4 peer-focus:text-primary-600 dark:peer-focus:text-primary-200 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7 peer-focus:bg-surface-300 dark:peer-focus:bg-surfacedark-300 peer-focus:px-1 peer-invalid:text-error-600 dark:peer-invalid:text-error-200">Désignation</label>
                    </div>
                    <div class="text-red-800 text-xs">@error('designation') {{ $message }} @enderror</div>
                    <div class="relative">
                        <button wire:click.prevent="store()" class="btn w-full relative flex flex-row items-center justify-center gap-x-2 py-2.5 px-6 rounded-[6.25rem] hover:shadow-md text-sm tracking-[.00714em] font-medium bg-primary-600 text-white dark:bg-primary-200 dark:text-primary-800">
                            <span class="material-symbols-outlined">add</span><span class="ml-1 compact-hide">
                                 {{ ($editModalOpen) ? "Mettre à jour" : " Ajouter un niveau" }}
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>