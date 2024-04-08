<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$event->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>
                        {{$event->name}}
                    </p>
                    <p>
                        Date: {{$event->created_at->format('Y-m-d')}}
                    </p>
                    <p>
                        User: <a href="{{route('user.show', $event->user_id)}}">{{$event->user_id}}</a>
                    </p>
                    @foreach($event->attributes as $key => $value)
                        <p>{{$key}}: {{$value}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
