<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <div class="box-info d-flex flex-column">
                            <h2 class="text-center font-black text-uppercase text-2xl">Informations</h2>
                            <div class="info d-flex align-items-center mt-5 justify-content-around">
                                <div class="img-box ">
                                    <img style="width:200px" src="{{ URL::to('/') }}/img/user-solid.svg" alt="">
                                </div>
                                <div class="info-box">
                                    <div class="info mb-4">
                                        <p class="font-extrabold pb-2">Nom:</p>
                                        <p>{{ Auth::user()->name }}</p>
                                    </div>
                                    <div class="info mb-4">
                                        <p class="font-extrabold pb-2">Email:</p>
                                        <p>{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
