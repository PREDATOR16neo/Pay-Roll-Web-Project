<div>
    <h1>Welcome to User Page</h1>

    @if ($errors->any())
        <div class="text-red-500">
            @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
            @endforeach
        </div>
    @endif

    @if (session('message'))
        <div class="text-green-500">
            {{ session('message') }}</div>
    @endif

    <form class="max-w-md mx-auto bg-white p-6 rounded-2xl shadow-lg space-y-5" wire:submit.prevent='store'>

        <h2 class="text-xl font-semibold text-gray-700 text-center">Form Input</h2>

        <!-- User -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">User</label>
            <input type="text" class="w-full border border-gray-500 px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" wire:model="name" placeholder="Masukkan nama...">
        </div>

        <!-- Position -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
            <input type="email" class="w-full border border-gray-500 px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" wire:model="email" placeholder="Masukkan email...">
        </div>

        <!-- Number Input -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Password</label>
            <input type="password" 
            class="w-full border border-gray-500 px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" 
            wire:model="password" 
            placeholder="Masukkan password...">
        </div>

        <!-- Button -->
        <div>
            @if ($editCheck == false)
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 transition duration-200 text-white font-medium py-2 rounded-lg shadow-md">
                    Save
                </button>
            @endif
        </div>


    </form>
    <div>
            @if ($editCheck == true)
                <button wire:click='update({{ $idEdit }})' 
                    class="w-full bg-purple-500 hover:bg-purple-700 transition duration-200 text-white font-medium py-2 rounded-lg shadow-md">
                    update
                </button>
            @endif
        </div>
    <div class="max-h-46 overflow-x-auto">

        <input type="text" class="form-control w-30 px-4 py-2 mb-2 rounded" wire:model.live='keyword'
            placeholder="Cari posisi">
        <table class="min-w-full divide-y-2 divide-gray-200">
            <thead class="sticky top-0 bg-white ltr:text-left rtl:text-right">
                <tr class="*:font-medium *:text-gray-900">
                    <th class="px-3 py-2 whitespace-nowrap">No</th>
                    <th class="px-3 py-2 whitespace-nowrap">Email</th>
                    <th class="px-3 py-2 whitespace-nowrap">Password </th>
                    <th class="px-3 py-2 whitespace-nowrap">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach ($users as $item)
                    <tr class="text-center">
                        <td class="px-3 py-2 whitespace-nowrap">{{ $loop->iteration }}

                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ $item->name }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ $item->email }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ $item->password }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <button class="bg-red-500 px-4 py-2 text-white rounded"
                                wire:click='destroy({{ $item->id }})'>Hapus</button>
                            @if ($editCheck == false)
                                <button class="bg-blue-500 px-4 py-2 text-white"
                                    wire:click='edit({{ $item->id }})'>Edit</button>
                            @endif

                            @if ($editCheck == true)
                                <button class="bg-blue-500 px-4 py-2 text-white" wire:click='clear()'>Clear</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>
