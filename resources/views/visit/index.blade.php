<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ET1ABV szakdolgozat - Visits
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="flex flex-col">
                        <section class="grid grid-cols-3 gap-2">
                            <div class="grow ">Date</div>
                            <div class="grow ">Page</div>
                            <div class="gorw ">User</div>
                        </section>
                        @foreach($visits as $visit)
                            <section class="my-2 grid grid-cols-3 gap-2">
                                <div class="">{{$visit->created_at}}</div>
                                <div class="">{{$visit->page}}</div>
                                <div class="">
                                    <a href="{{route('user.show', $visit->user_id)}}">{{$visit->user->id}}</a>
                                    </div>
                            </section>
                        @endforeach
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
