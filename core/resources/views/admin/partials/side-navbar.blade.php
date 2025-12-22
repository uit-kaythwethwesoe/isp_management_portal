<?php
   $lang_code = $currentLang->code;
   $D = json_decode(json_encode(Auth::guard('admin')->user()->get_role()),true);
   $arr = [];
   foreach($D as $v)
   {
     $arr[] = $v['permission_id'];
   }
   ?>
<style>
   .abcded {
   position: absolute;
   /* left: 0; */
   margin: -1px -3px 0px 5px;
   /* width: 18px; */
   height: 23px;
   border-radius: 27%;
   border: 3px solid #2c3e50;
   background: #95a5a6;
   padding: 2px 5px 20px;
   border-color: yellow;
   /* padding-left: 6px; */
   }
</style>
<?php  $count = DB::table('chat')
   ->select(DB::raw('count(*) as count'))
   ->where('read_status', '=', 0)
   ->where('sender_userid', '!=', 1 )
   ->first()
   ->count;
    ?>
<style>
   .menu-open1{
   background-color:red!important;
   }
</style>
<aside class="main-sidebar elevation-4 main-sidebar elevation-4 sidebar-light-primary">
   <!-- Sidebar -->
   <div class="sidebar pt-0 mt-0">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
         <a href="{{ route('admin.dashboard',app()->getLocale()) }}" class="name text-dark" target="_blank">
         <img src="{{ asset('assets/front/img/'.$commonsetting->header_logo) }}" alt="">
         </a>
      </div>
      <!-- Sidebar Menu -->
      @if(!empty($arr))
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
               <a href="{{ route('admin.dashboard',app()->getLocale()) }}"
                  class="nav-link @if(request()->path() == 'admin/dashboard') active @endif">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                     {{ __('Dashboard') }}
                  </p>
               </a>
            </li>
            
            @if(in_array("1", $arr))
            <li class="nav-item">
               <a href="{{ route('admin.payment_query',app()->getLocale()) }}" class="nav-link
                  @if(request()->routeIs('admin.payment_query')) active
                  @endif 
                  @if(request()->routeIs('admin.payment_query')) active
                  @endif
                  ">
                  <i class="nav-icon fas fa-money-check-alt"></i>
                  <p> {{ __('Payment Query') }}</p>
               </a>
            </li>
            @endif
            
            @if(in_array("2", $arr))
            <li class="nav-item">
               <a href="{{ route('admin.fault_query',app()->getLocale()) }}"
                  class="nav-link @if(request()->routeIs('admin.fault_query')) active @endif">
                  <i class="nav-icon fas fa-briefcase"></i>
                  <p>
                     {{ __('Fault Report Query') }}
                  </p>
               </a>
            </li>
            @endif
            
            @if(in_array("36", $arr))
            <li class="nav-item">
               <a href="{{ route('admin.install_query',app()->getLocale()) }}"
                  class="nav-link @if(request()->routeIs('admin.install_query')) active @endif">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                     {{ __('Apply install Query') }}
                  </p>
               </a>
            </li>
            @endif
            
            @if(in_array("37", $arr))
            <li class="nav-item">
               <a href="{{ route('admin.message',app()->getLocale()) }}"
                  class="nav-link @if(request()->routeIs('admin.message')) active @endif">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                     {{ __('Reply User Message') }}
                     <?php if($count==0) echo ""; else { ?> <span class="abcded"><i class="fas fa-bell" onclick="" aria-hidden="true"> <?php echo $count; ?> </i></span><?php } ?>
                  </p>
               </a>
            </li>
            @endif
            
            @if(in_array("39", $arr) || in_array("40", $arr))
            <li class="nav-item has-treeview
               @if(request()->routeIs('admin.marketting_information')) menu-open @endif
               @if(request()->routeIs('admin.user_notification')) menu-open @endif
               ">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-box-open"></i>
                  <p>
                     {{ __('Publish Information') }}
                     <i class="fas fa-angle-left right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  @if(in_array("39", $arr))
                  <li class="nav-item">
                     <a href="{{route('admin.marketting_information',app()->getLocale())}}" class="nav-link
                        @if(request()->routeIs('admin.marketting_information')) active @endif ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Marketing information') }}</p>
                     </a>
                  </li>
                  @endif
                  @if(in_array("40", $arr))
                  <li class="nav-item">
                     <a href="{{route('admin.user_notification',app()->getLocale())}}" class="nav-link
                        @if(request()->routeIs('admin.user_notification')) active @endif
                        ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __("User Notifications") }}</p>
                     </a>
                  </li>
                  @endif
               </ul>
            </li>
            @endif
            
            @if(in_array("42", $arr) || in_array("58", $arr) || in_array("43", $arr))
            <li class="nav-item has-treeview @if(request()->routeIs('admin.user_query')) menu-open @endif
               @if(request()->routeIs('admin.user_disabled')) menu-open @endif
               @if(request()->routeIs('admin.user_update')) menu-open @endif  
               @if(request()->routeIs('admin.userdetails')) menu-open @endif
               @if(request()->routeIs('admin.bind_user_query')) menu-open @endif ">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                     {{ __('User Admin') }}
                     <i class="fas fa-angle-left right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  @if(in_array("42", $arr))
                  <li class="nav-item">
                     <a href="{{route('admin.user_query',app()->getLocale())}}" class="nav-link
                        @if(request()->routeIs('admin.user_query')) active
                        @endif
                        @if(request()->routeIs('admin.userdetails')) active
                        @endif
                        ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('User Query') }}</p>
                     </a>
                  </li>
                  @endif
                  @if(in_array("58", $arr))
                  <li class="nav-item">
                     <a href="{{route('admin.bind_user_query',app()->getLocale())}}" class="nav-link
                        @if(request()->routeIs('admin.bind_user_query')) active
                        @endif ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Bind User') }}</p>
                     </a>
                  </li>
                  @endif
                  @if(in_array("43", $arr))
                  <li class="nav-item">
                     <a href="{{route('admin.user_update',app()->getLocale())}}" class="nav-link
                        @if(request()->routeIs('admin.user_update')) active @endif
                        ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __("User Update") }}</p>
                     </a>
                  </li>
                  @endif
               </ul>
            </li>
            @endif
            
            @if(in_array("45", $arr) || in_array("46", $arr) || in_array("48", $arr))
            <li class="nav-item has-treeview
               @if(request()->routeIs('admin.role_add')) menu-open @endif
               @if(request()->routeIs('admin.update_role')) menu-open @endif
               @if(request()->routeIs('admin.role_manage')) menu-open @endif
               @if(request()->routeIs('admin.user.form')) menu-open @endif
               @if(request()->routeIs('admin.register.user')) menu-open  @endif
               @if(request()->routeIs('register.user.view')) menu-open @endif
               @if(request()->routeIs('admin.language.index')) menu-open
               @elseif(request()->path() == 'en/admin/language/add') menu-open
               @elseif(request()->path() == 'ch/admin/language/add') menu-open
               @elseif(request()->is('admin/language/21/edit')) menu-open
               @elseif(request()->is('admin/language/*/edit/keyword')) menu-open
               @endif
               ">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fas fa-cog"></i>
                  <p>
                     {{ __('Settings') }}
                     <i class="fas fa-angle-left right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  @if(in_array("45", $arr))
                  <li class="nav-item">
                     <a href="{{route('admin.language.index',app()->getLocale())}}" class="nav-link
                        @if(request()->routeIs('admin.language.index')) active
                        @elseif(request()->path() == 'admin/language/add') active
                        @elseif(request()->is('admin/language/21/edit')) active
                        @elseif(request()->is('admin/language/*/edit/keyword')) active
                        @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                           {{ __('Language') }}
                        </p>
                     </a>
                  </li>
                  @endif
                  @if(in_array("46", $arr))
                  <li class="nav-item">
                     <a href="{{route('admin.role_manage',app()->getLocale())}}" class="nav-link
                        @if(request()->routeIs('admin.role_manage')) active 
                        @endif
                        @if(request()->routeIs('admin.role_add')) active 
                        @endif
                        @if(request()->routeIs('admin.update_role')) active @endif
                        ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __("Role manage") }}</p>
                     </a>
                  </li>
                  @endif
                  @if(in_array("47", $arr))
                  <li class="nav-item">
                     <a href="{{ route('admin.register.user',app()->getLocale())}}" class="nav-link
                        @if(request()->routeIs('admin.register.user')) active
                        @endif 
                        @if(request()->routeIs('register.user.view')) active
                        @endif
                        ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Role assigned users') }}</p>
                     </a>
                  </li>
                  @endif
                  @if(in_array("48", $arr))
                  <li class="nav-item">
                     <a href="{{ route('bank.settings',app()->getLocale())}}" class="nav-link
                        ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Bank Settings') }}</p>
                     </a>
                  </li>
                  @endif
               </ul>
            </li>
            @endif
            
            @if(in_array("50", $arr) || in_array("51", $arr) || in_array("54", $arr) || in_array("53", $arr) || in_array("55", $arr) || in_array("52", $arr))
            <li class="nav-item has-treeview @if(request()->routeIs('admin.basicinfo')) menu-open  
               @elseif(request()->routeIs('admin.dynamic-page')) menu-open 
               @elseif(request()->routeIs('admin.app_banner')) menu-open 
               @elseif(request()->routeIs('admin.dynamic_page.edit')) menu-open 
               @elseif(request()->routeIs('admin.package')) menu-open @endif
               @if(request()->routeIs('admin.package.add')) menu-open @endif
               @if(request()->routeIs('admin.app-banner')) menu-open @endif
               @if(request()->routeIs('admin.Preferential_activities')) menu-open @endif
               @if(request()->routeIs('admin.errormessage')) menu-open @endif
               @if(request()->routeIs('admin.package')) menu-open @endif
               @if(request()->routeIs('admin.package.edit')) menu-open @endif
               ">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fas fa-mobile"></i>
                  <p>
                     {{ __('App Settings') }}
                     <i class="fas fa-angle-left right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  @if(in_array("50", $arr))
                  <li class="nav-item">
                     <a href="{{ route('admin.basicinfo',app()->getLocale()). '?language=' . $lang_code }}"
                        class="nav-link 
                        @if(request()->routeIs('admin.basicinfo')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Basic Information') }}</p>
                     </a>
                  </li>
                  @endif
                  @if(in_array("51", $arr))
                  <li class="nav-item">
                     <a href="{{route('admin.app_banner',app()->getLocale())}}" class="nav-link
                        @if(request()->routeIs('admin.app_banner')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __("App Banner") }}</p>
                     </a>
                  </li>
                  @endif
                  @if(in_array("54", $arr))
                  <li class="nav-item">
                     <a href="{{route('admin.Preferential_activities',app()->getLocale())}}" class="nav-link
                        @if(request()->routeIs('admin.Preferential_activities')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __("Preferential activities") }}</p>
                     </a>
                  </li>
                  @endif
                  @if(in_array("53", $arr))
                      <li class="nav-item">
                         <a href="{{route('admin.errormessage',app()->getLocale())}}" class="nav-link
                            @if(request()->routeIs('admin.errormessage')) active @endif 
                            ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __("Fault code") }}</p>
                         </a>
                      </li>
                  @endif
                  @if(in_array("55", $arr))
                  <li class="nav-item">
                     <a href="{{route('admin.package',app()->getLocale())}}" class="nav-link  
                        @if(request()->routeIs('admin.package')) active @endif 
                        @if(request()->routeIs('admin.package.add')) active @endif 
                        @if(request()->routeIs('admin.package.edit')) active @endif 
                        ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __("Package") }}</p>
                     </a>
                  </li>
                  @endif
                  @if(in_array("52", $arr))
                  <li class="nav-item">
                     <a href="{{ route('admin.dynamic-page',app()->getLocale()). '?language=' . $lang_code }}"
                        class="nav-link @if(request()->path() == 'admin/dynamic-page') active @endif
                        @if(request()->path() == 'admin/dynamic-page/edit/en') active @endif
                        @if(request()->routeIs('admin.dynamic-page.edit')) active @endif 
                        ">
                        <i class="nav-icon  fab fa-sith"></i>
                        <p>
                           {{ __('App Pages') }}
                        </p>
                     </a>
                  </li>
                  @endif
               </ul>
            </li>
            @endif
            
            @if(in_array("60", $arr))
                <li class="nav-item">
                    <a href="{{ route('admin.promotion',app()->getLocale()) }}" class="nav-link @if(request()->routeIs('admin.promotion')) active @endif">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>{{ __('Promotions') }}</p>
                    </a>
                </li>
            @endif
            
            @if(in_array("61", $arr))
                <li class="nav-item">
                    <a href="{{ route('admin.payment.process',app()->getLocale()) }}" class="nav-link @if(request()->routeIs('admin.payment.process')) active @endif">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Ban ID'S</p>
                    </a>
                </li>
            @endif
            
            @if(in_array("62", $arr) || in_array("63", $arr) || in_array("64", $arr))
            <li class="nav-item has-treeview
               @if(request()->routeIs('admin.cbpay')) menu-open @endif
               @if(request()->routeIs('admin.kbzpay')) menu-open @endif
               @if(request()->routeIs('admin.wavepay')) menu-open @endif
               ">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-box-open"></i>
                  <p>
                     {{ __('Pending Payments') }}
                     <i class="fas fa-angle-left right"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  @if(in_array("62", $arr))
                  <li class="nav-item">
                     <a href="{{route('admin.cbpay',app()->getLocale())}}" class="nav-link
                        @if(request()->routeIs('admin.cbpay')) active @endif ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('CB Pay') }}</p>
                     </a>
                  </li>
                  @endif
                  @if(in_array("63", $arr))
                  <li class="nav-item">
                     <a href="{{route('admin.kbzpay',app()->getLocale())}}" class="nav-link
                        @if(request()->routeIs('admin.kbzpay')) active @endif
                        ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __("KBZ Pay") }}</p>
                     </a>
                  </li>
                  @endif
                  @if(in_array("64", $arr))
                  <li class="nav-item">
                     <a href="{{route('admin.wavepay',app()->getLocale())}}" class="nav-link
                        @if(request()->routeIs('admin.wavepay')) active @endif
                        ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __("Wave Pay") }}</p>
                     </a>
                  </li>
                  @endif
               </ul>
            </li>
            @endif
         </ul>
      </nav>
      @else
      <li class="nav-item">
         <a href=""
            class="nav-link">
            <i class="nav-icon fas fa-money-check-alt"></i>
            <p>
               {{ __('Sorry,cant find any permission') }}
            </p>
         </a>
      </li>
      @endif
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>