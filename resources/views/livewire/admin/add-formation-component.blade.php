<div>

    @include('extends.admin-side-bar')
    <main class="lg:flex">
        @include('extends.admin-aside')
        <!-- content -->
        <div class="main-content flex-grow min-h-[100%] py-20 relative px-4 lg:pr-8 lg:pl-3">
            <!-- heading -->

            <!-- content -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-4 md:mb-6">
                <div class="col-span-1 flex flex-col gap-6">
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg shadow-gray-100/10 dark:shadow-gray-700/10 overflow-hidden">
                        <!-- cover -->
                        <div class="overflow-hidden">
                            <div class="group h-36 overflow-hidden relative">
                                <img src="{{ asset('admin/src/img/cover/cover2.jpg') }}" alt="cover image" class="w-full">
                            </div>

                            <div class="flex justify-center -mt-10 relative">
                                <img src="{{ asset('admin/src/img/avatar.png') }}" alt="avatar" class="rounded-full w-24 h-24 bg-primary-600 text-white dark:bg-primary-200 dark:text-neutral-900 border-solid border-white border-2 -mt-3">
                            </div>
                            <div class="text-center px-4 pb-6 pt-2">
                                <button class="btn-elevated relative inline-flex flex-row items-center justify-center gap-x-2 py-2.5 px-6 rounded-[6.25rem] shadow-lg text-md tracking-[.00714em] font-medium bg-surface-100 hover:bg-surface-200 focus:bg-surface-400 text-primary-600 dark:bg-surfacedark-100 dark:hover:bg-surfacedark-200 dark:focus:bg-surfacedark-400 dark:text-primary-200">
                                    <span class="material-symbols-outlined">
                                         post_add
                                    </span> Ajouter une formation
                                </button>
                            </div>
                        </div>
                        <!-- information -->
                    </div>
                </div>

                <div class="md:col-span-2 flex flex-col gap-6">
                    <!-- card -->
                    <div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow-lg shadow-cyan-100/10 dark:shadow-cyan-700/10 h-full">
                        <div class="relative">
                            <!-- tabs -->
                            <div class="tabs flex flex-col w-full">
                                <!-- tabs header -->
                                <div class="relative flex flex-row items-center">
                                    <button data-type="tabs" data-target="#tab-4" class="active w-2/3 sm:w-[120px] h-16 px-4 flex flex-col justify-end items-center gap-1 relative py-2 hover:bg-surface-100 dark:hover:bg-surfacedark-100">
                                        <span class="material-symbols-outlined">edit</span>
                                        <span class="text-sm tracking-[.00714em]">Formulaire</span>
                                    </button>
                                    <!-- indicator -->
                                    <div data-type="indicator" class="absolute left-0 bottom-0 transition-all duration-200 ease-in-out bg-primary-600 dark:bg-primary-200 w-1/3 sm:w-[120px] h-0.5 rounded-t-full"></div>
                                </div>
                                <hr class="border-gray-200 dark:border-gray-700">
                                <!-- tabs content -->
                                <div class="flex flex-col">
                                    <div id="tab-4" role="tabpanel" class="active [&amp;.active]:block hidden py-4 transition duration-400 ease-in-out">
                                        <div class="flex flex-col gap-6">
                                            <!-- name -->
                                            <div class="flex flex-row items-center gap-4">
                                                <!-- first name -->
                                                <div class="relative z-0 w-full" >
                                                    <input type="text" aria-label="inputtext1" wire:model="intitule" id="inputtext1" class="w-full h-12 block leading-5 relative py-2 px-4 rounded bg-neutral-10 dark:bg-neutral-900 border focus:border-2 border-gray-500 overflow-x-auto focus:outline-none focus:border-primary-600 focus:ring-0 dark:text-gray-200 dark:border-gray-400 dark:focus:border-primary-200 peer" placeholder=" " value="">

                                                    <label for="inputtext1" class="absolute tracking-[.03125em] text-gray-500 dark:text-gray-400 bg-neutral-10 dark:bg-neutral-900 duration-300 transform px-1 -translate-y-6 scale-75 top-3 z-10 origin-[0] left-4 peer-focus:left-4 peer-focus:text-primary-600 dark:peer-focus:text-primary-200 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 peer-focus:bg-neutral-10 dark:peer-focus:bg-neutral-900 peer-focus:px-1 peer-invalid:text-error-600 dark:peer-invalid:text-error-200">
                                                        Titre</label>
                                                    <div class="w-full text-red-800 text-xs mt-2">@error('intitule') {{ $message }} @enderror</div>
                                                </div>

                                                <!-- last name -->
                                                <div class="relative z-0 w-full">
                                                    <input type="text" aria-label="inputtext2" wire:model="duree" id="inputtext2" class="w-full h-12 block leading-5 relative py-2 px-4 rounded bg-neutral-10 dark:bg-neutral-900 border focus:border-2 border-gray-500 overflow-x-auto focus:outline-none focus:border-primary-600 focus:ring-0 dark:text-gray-200 dark:border-gray-400 dark:focus:border-primary-200 peer" placeholder=" " value="">

                                                    <label for="inputtext2" class="absolute tracking-[.03125em] text-gray-500 dark:text-gray-400 bg-neutral-10 dark:bg-neutral-900 duration-300 transform px-1 -translate-y-6 scale-75 top-3 z-10 origin-[0] left-4 peer-focus:left-4 peer-focus:text-primary-600 dark:peer-focus:text-primary-200 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 peer-focus:bg-neutral-10 dark:peer-focus:bg-neutral-900 peer-focus:px-1 peer-invalid:text-error-600 dark:peer-invalid:text-error-200">
                                                        Durée</label>
                                                    <div class="text-red-800 text-xs mt-2">@error('duree') {{ $message }} @enderror</div>
                                                </div>
                                            </div>

                                            <!-- description -->
                                                <label for="content" class="block text-lg font-medium text-gray-800">Description</label>
                                                <div class="relative z-0" wire:ignore>
                                                    <textarea data-description="@this" wire:model="description" class="w-full h-32 block leading-5 relative py-2 px-4 rounded bg-neutral-10 dark:bg-neutral-900 border focus:border-2 border-gray-500 overflow-x-auto focus:outline-none focus:border-primary-600 focus:ring-0 dark:text-gray-200 dark:border-gray-400 dark:focus:border-primary-200 peer" placeholder=" "
                                                              id="description" rows="3">
                                                        {{ $description }}
                                                    </textarea>
                                                </div>
                                                <div class="text-red-800 text-xs">@error('description') {{ $message }} @enderror</div>

                                                <label for="content" class="block text-lg font-medium text-gray-800">Condition</label>
                                                  <div class="z-0" wire:ignore>
                                                        <textarea data-condition="@this"  wire:model="condition" class="w-full h-32 block leading-5 relative py-2 px-4 rounded bg-neutral-10 dark:bg-neutral-900 border focus:border-2 border-gray-500 overflow-x-auto focus:outline-none focus:border-primary-600 focus:ring-0 dark:text-gray-200 dark:border-gray-400 dark:focus:border-primary-200 peer" placeholder=" "
                                                                  id="condition" rows="3">
                                                            {{ $condition }}
                                                        </textarea>
                                                  </div>
                                                 <div class="text-red-800 text-xs">@error('condition') {{ $message }} @enderror</div>
                                                <!-- Upload cover -->
                                                <label for="content" class="block text-lg font-medium text-gray-800">Raison</label>
                                                <div class=" z-0" wire:ignore>
                                                    <textarea data-raison="@this" wire:model="raison" class="w-full h-32 block leading-5 relative py-2 px-4 rounded bg-neutral-10 dark:bg-neutral-900 border focus:border-2 border-gray-500 overflow-x-auto focus:outline-none focus:border-primary-600 focus:ring-0 dark:text-gray-200 dark:border-gray-400 dark:focus:border-primary-200 peer" placeholder=" "
                                                              id="raison" rows="3">
                                                        {{ $raison }}
                                                    </textarea>
                                                </div>
                                                <div class="text-red-800 text-xs">@error('raison') {{ $message }} @enderror</div>

                                        </div>
                                    </div>
                                   <div class="relative flex justify-end pt-4">
                                        <button wire:click.prevent="store()" id="submit" class="btn relative inline-flex flex-row items-center justify-center gap-x-2 py-2.5 px-6 rounded-[6.25rem] hover:shadow-md text-sm tracking-[.00714em] font-medium bg-primary-600 text-white dark:bg-primary-200 dark:text-primary-800">
                                            <span class="material-symbols-outlined">save</span>
                                           {{ $id ? 'Mettre à jour' : 'Enregistrer'}}
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end content -->
        </div>

    </main>


</div>
@push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                @this.set('description', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
        /*************************/
        ClassicEditor
            .create( document.querySelector( '#condition' ) )
            .then( editor => {
                editor.model.document.on('change:data', () => {
                     @this.set('condition', editor.getData());
                })
            })
            .catch( error => {
                console.error( error );
            } );
        /**************************/
        ClassicEditor
            .create( document.querySelector( '#raison' ) )
            .then( editor => {
                editor.model.document.on('change:data', () => {
                @this.set('raison', editor.getData());
                })
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush