<x-app-layout>
    <x-slot name="header">
        <a href="{{route('visit.index')}}" class="inline-block absolute"><< Back</a>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{$visit->created_at->format('Y-m-d')}} - {{$visit->page}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="font-bold">
                        {{$visit->page}}
                    </p>
                    <p>
                        Date: {{$visit->created_at->format('Y-m-d')}}
                    </p>
                    <p>
                        User: <a href="{{route('TrackedUser.show', $visit->user_id)}}">{{$visit->user_id}}</a>
                    </p>
                    <p>IP address: {{$visit->ip_address}}</p>
                    <p>Country: {{$visit->country}}</p>
                    <p class="font-bold mt-3">Browser info:</p>
                    @foreach($visit->browser_info as $key => $value)
                        <p>{{$key}}: {{$value}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
