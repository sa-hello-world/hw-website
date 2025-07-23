<footer class="bg-hw-dark text-white px-6 md:px-20 py-12 text-sm font-bayon">
    <div class="flex flex-col md:flex-row md:justify-start md:space-x-20 space-y-8 md:space-y-0">
        <!-- User Quick Access -->
        <div>
            <h4 class="uppercase tracking-wider mb-4 text-white text-lg">Dashboard</h4>
            <ul class="space-y-2">
                <li><a href="{{ route('dashboard') }}" class="hover:underline">My Hub</a></li>
                <li><a href="{{ route('events') }}" class="hover:underline">My Events</a></li>
            </ul>
        </div>

        <!-- Legal -->
        <div>
            <h4 class="uppercase tracking-wider mb-4 text-white text-lg">Legal</h4>
            <ul class="space-y-2">
                <li><a href="#" class="hover:underline">Privacy Policy</a></li>
                <li><a href="#" class="hover:underline">Licensing</a></li>
                <li><a href="#" class="hover:underline">Terms and Conditions</a></li>
            </ul>
        </div>
    </div>

    <div class="text-xs text-gray-400 mt-8">
        © 2025 SA Hello World | Made by SA Hello World Website Team. All rights reserved.
    </div>
</footer>
