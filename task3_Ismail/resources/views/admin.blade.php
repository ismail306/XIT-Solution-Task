<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    <h4>Pending User List</h4>
                </div>
                @if($users==null)
                <div class="pl-4 text-info">
                    <h4>No Pending User</h4>
                </div>
                <table class="table mx-4">
                    <thead>
                        <tr>
                            <th scope="col">SN</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                </table>
                @else
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SN</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        @php
                        $sn = 1;
                        @endphp
                        @foreach ($users as $user)

                        <tbody>
                            <tr>
                                <th scope="row">{{$sn}}</th>
                                <td>{{$user->name}}</td>
                                <td>j{{$user->email}}</td>
                                <td>
                                    <form action="{{route('user.approve')}}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id" value="{{$user->id}}">
                                        <button type="submit" name="status" value="approved" class="btn buttn-success"">Accept</button>
                                    </form>

                                    <form action=" {{route('user.delete')}}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{$user->id}}">

                                            <button type="submit" class="btn buttn-danger">Decline</button>
                                    </form>
                                </td>
                            </tr>

                        </tbody>

                        @php
                        $sn++;
                        @endphp
                        @endforeach
                    </table>


                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>