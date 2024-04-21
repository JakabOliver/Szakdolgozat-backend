<x-app-layout>
    @vite('resources/js/dashboard.js')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ET1ABV szakdolgozat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Dashboard
                    <div class="grid grid-cols-3">
                        <div>
                            <canvas id="requests"></canvas>
                        </div>
                        <div>
                            <canvas id="events"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
