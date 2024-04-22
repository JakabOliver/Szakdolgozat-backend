<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ET1ABV szakdolgozat - Admins
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 my-2">
                    <section class="mb-3">
                        <a class="border border-gray-300 bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 rounded" href="{{route('user.create')}}">Invite new user</a>
                    </section>
                    <section class="flex flex-col">
                        <section class="grid grid-cols-4 gap-2">
                            <div class="grow">Name</div>
                            <div class="grow">Email</div>
                        </section>
                        <section id="users">
                            @foreach($users as $user)
                                <section class="grid grid-cols-4 gap-2">
                                <div class="grow"><a href="{{route('user.show', $user)}}">{{$user->name}}</a></div>
                                <div class="grow">{{$user->email}}</div>
                                </section>
                            @endforeach
                        </section>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
