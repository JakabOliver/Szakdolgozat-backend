<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$user->id}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Events</h3>
                    @foreach($user->events as $event)
                        <a href="{{route('event.show', $event->id)}}">
                            <p>{{$event->name}}
                                @if(empty($event->attributes) === false)
                                    <small>{{$event->attributes}}</small>
                                @endif
                            </p>
                        </a>
                    @endforeach
                    <h3>Page loads</h3>
                    @foreach($user->pageVisits as $visit)
                        <p>
                            {{$visit->created_at->format('Y-m-d')}}
                            <a href="{{route('visit.show', $visit->id)}}">
                                {{$visit->page}}
                            </a>
                        </p>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
