<x-app-layout>
    @vite('resources/js/events.js')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ET1ABV szakdolgozat - Events
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-9 gap-4 gap-6">
                        <div class="col-span-2">
                            <label for="date_from" class="block my-2 flex justify-between">
                                <span>  From</span>
                                <input type="date" name="from" id="date_from" class="rounded">
                            </label>
                            <label for="date_to" class="block my-2 flex justify-between">
                                To
                                <input type="date" name="to" id="date_to" class="rounded">
                            </label>
                        </div>
                        <div class="col-span-3 flex-col">
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="page">
                                    Event
                                </label>
                                <select name="event" id="event" class="w-full py-2 rounded">
                                    <option value="">All</option>
                                    @foreach($events as $event)
                                        <option value="{{$event}}">{{$event}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-span-3 flex-col">
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="user">
                                    User
                                </label>
                                <select name="user" id="user" class="rounded w-full">
                                    <option value="">All</option>
                                    @foreach($users as $user)
                                        <option value="{{$user}}">{{$user}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    id="apply-filter-button">
                                Apply
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 my-2">
                    <section class="flex flex-col">
                        <section class="grid grid-cols-4 gap-2">
                            <div class="grow">Date</div>
                            <div class="grow">Event</div>
                            <div class="grow">User</div>
                            <div class="grow">Country</div>
                        </section>
                        <section id="events">
                        </section>
                    </section>
                    <section>
                        <label for="limit">Limit:
                            <select name="limit" id="limit">
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                            </select>
                        </label>

                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
