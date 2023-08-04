   <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
       <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
       <div class="logo">
           <a href="{{ route('admin.dashboard') }}" class="simple-text">
               Admin Panel
           </a>
       </div>
       <div class="sidebar-wrapper">
           <ul class="nav">
               <li class="nav-item">
                   <a class="nav-link {{ Request::is('admin/dashboard*') ? 'nav_active' : '' }}" href="{{ route('admin.dashboard') }}">
                       <p>Dashboard</p>
                   </a>
               </li>
               <li class="nav-item">
                   <a class="nav-link {{ Request::is('admin/users-profile*') ? 'nav_active' : '' }}" href="{{ route('admin.users.profile') }}">
                       <p>Users Profile</p>
                   </a>
               </li>

               <li class="nav-item">
                   <a class="nav-link {{ Request::is('admin/category*') ? 'nav_active' : '' }}" href="{{ route('category.index') }}">
                       <p>category</p>
                   </a>
               </li>
               <li class="nav-item">
                   <a class="nav-link {{ Request::is('admin/item*') ? 'nav_active' : '' }}" href="{{ route('item.index') }}">
                       <p>Item</p>
                   </a>
               </li>
               <li class="nav-item">
                   @php
                       $count = \App\Models\Rating::where('is_read', 0)->count();
                   @endphp
                   <a class="nav-link {{ Route::is('user.rating') ? 'nav_active' : '' }} {{ Route::is('user.rating.show') ? 'nav_active' : '' }}"
                    href="{{ route('user.rating') }}">
                       <p>User Ratings <span class="badge badge-secondary">{{ $count }}</span></p>
                   </a>
               </li>
               <li class="nav-item">
                   @php
                       $count = \App\Models\Question::where('is_read', 0)->count();
                   @endphp
                   <a class="nav-link {{ Route::is('user.questions') ? 'nav_active' : '' }} {{ Route::is('user.rating.show') ? 'nav_active' : '' }}"
                    href="{{ route('user.questions') }}">
                       <p>User Questions <span class="badge badge-secondary">{{ $count }}</span></p>
                   </a>
               </li>
               <li class="nav-item">
                   @php
                       $count = \App\Models\OrderItem::where('is_read', 0)->get();
                   @endphp
                   <a class="nav-link {{ Request::is('admin/order/process*') ? 'nav_active' : '' }} {{ Request::is('order/process/info/show*') ? 'active' : '' }}" href="{{ route('user.order.process.index') }}">
                       <p>User Order Process <span class="badge badge-secondary">{{ $count->count() }}</span></p>
                   </a>
               </li>
               <li class="nav-item">
                   <a class="nav-link {{ Request::is('admin/contact*') ? 'nav_active' : '' }}" href="{{ route('contact.index') }}">
                       <p>Contact</p>
                   </a>
               </li>
           </ul>
       </div>
   </div>
