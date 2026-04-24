<div>
    <h1>Welcome to Employee Page</h1>

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
            <select wire:model='user_id'
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <option value="">--- User ---</option>
                @foreach ($users as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Position -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Position</label>
            <select wire:model='position_id'
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <option value="">--- Position ---</option>
                @foreach ($positions as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Number Input -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Gaji</label>
            <input wire:model='salary' type="number"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                placeholder="Masukkan gaji...">
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
                    <th class="px-3 py-2 whitespace-nowrap">#</th>
                    <th class="px-3 py-2 whitespace-nowrap">Username</th>
                    <th class="px-3 py-2 whitespace-nowrap">Position</th>
                    <th class="px-3 py-2 whitespace-nowrap">Salary</th>
                    <th class="px-3 py-2 whitespace-nowrap">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach ($employees as $item)
                    <tr class="text-center">
                        <td class="px-3 py-2 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ $item->user->name }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ $item->position->name }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">Rp. 0{{ number_format($item->salary) }}</td>
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
