<x-layout.default>
    @if(session('success'))
        <div class="max-w-2xl mx-auto p-4 bg-green-100 text-green-700 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-md">
        <h2 class="text-2xl font-semibold mb-4">Add an Announcement</h2>
        <form action="{{ route('announcements.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="4" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add Announcement</button>
            </div>
        </form>
    </div>

    <!-- Posted Announcements -->
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-md mt-8">
        <h2 class="text-2xl font-semibold mb-4">Posted Announcements</h2>
        @if($announcements->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sender Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Posted</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($announcements as $announcement)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $announcement->sender_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $announcement->message }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($announcement->date_posted)->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-700">No announcements posted yet.</p>
        @endif
    </div>
</x-layout.default>
