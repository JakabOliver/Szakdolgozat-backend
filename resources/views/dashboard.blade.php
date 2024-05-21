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
                    <div class="grid grid-cols-3 gap-3">
                        <div class="requests-chart border border-gray-300 rounded">
                            <div class="selectors grid grid-cols-3 w-80 mx-auto">
                                <div class="border m-2 p-1 bg-gray-500 text-center option active" data-value="7">7D</div>
                                <div class="border m-2 p-1 bg-gray-500 text-center option" data-value="30">30D</div>
                                <div class="border m-2 p-1 bg-gray-500 text-center option" data-value="90">3M</div>
                            </div>
                            <canvas id="requests"></canvas>
                        </div>
                        <div class="events-chart border border-gray-300 rounded">
                            <div class="selectors grid grid-cols-3 w-80 mx-auto">
                                <div class="border m-2 p-1 bg-gray-500 text-center option active" data-value="1">1M</div>
                                <div class="border m-2 p-1 bg-gray-500 text-center option" data-value="3">3M</div>
                                <div class="border m-2 p-1 bg-gray-500 text-center option" data-value="6">6M</div>
                            </div>
                            <canvas id="events"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
