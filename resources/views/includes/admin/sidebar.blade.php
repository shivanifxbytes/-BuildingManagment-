<div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
  <ul class="sidebar-menu">
    <li class="active">
       <a class="" href="{{ url('/') }}/dashboard">
         <span>{{ __('messages.dashboard') }}</span>
       </a>
     </li>
      <li>
       <a class="" href="{{ url('/') }}/users">
         <span>{{ __('messages.flats') }}</span>
       </a>
     </li>
     <li>
       <a class="" href="{{ url('/') }}/maintenanceMaster">
         <span>{{ __('messages.maintenance_master') }}</span>
       </a>
     </li>
     <li>    
       <a class="" href="{{ url('/') }}/flatType">
         <span>{{ __('messages.flat_type') }}</span>
       </a>
     </li>
      <li>
       <a class="" href="{{ url('/') }}/maintenanceTransaction">
         <span>{{ __('messages.maintenance_transaction') }}</span>
       </a>
     </li>
      <li>
       <a class="" href="{{ url('/') }}/maintenanceTransaction">
         <span>{{ __('messages.monthly_expenses') }}</span>
       </a>
     </li>
    </ul>
</div>
