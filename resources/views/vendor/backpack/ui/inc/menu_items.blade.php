{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />
<x-backpack::menu-item title="Teams" icon="la la-question" :link="backpack_url('team')" />
<x-backpack::menu-item title="Submissions" icon="la la-question" :link="backpack_url('submission')" />
<x-backpack::menu-item title="Submission versions" icon="la la-question" :link="backpack_url('submission-version')" />
<x-backpack::menu-item title="Comments" icon="la la-question" :link="backpack_url('comment')" />