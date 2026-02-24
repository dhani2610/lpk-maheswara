 <nav id="sidebar" class="sidebar">
     <div class="sidebar-brand">
        {{-- @dd(\App\Models\Setting::first()->site_name) --}}
         <i class="fa-solid fa-graduation-cap me-2"></i> {{ \App\Models\Setting::first()->site_name ?? 'LPK Maheswara' }}
     </div>
     <ul class="sidebar-nav">
         <li><a href="{{ url('/dashboard') }}" class=" "><i class="fa-solid fa-house"></i> Dashboard</a></li>
         <li><a href="{{ url('/slider') }}"><i class="fa-solid fa-images"></i> Slider</a></li>
         <li><a href="{{ url('/about') }}"><i class="fa-solid fa-circle-info"></i> About</a></li>
         <li><a href="{{ url('/program') }}"><i class="fa-solid fa-book-open"></i> Program</a></li>
         <li><a href="{{ url('/gallery') }}"><i class="fa-solid fa-camera-retro"></i> Gallery</a></li>
         <li><a href="{{ url('/contact') }}"><i class="fa-solid fa-address-book"></i> Contact</a></li>
         <li><a href="{{ url('/setting') }}"><i class="fa-solid fa-gear"></i> Setting</a></li>
     </ul>
 </nav>
