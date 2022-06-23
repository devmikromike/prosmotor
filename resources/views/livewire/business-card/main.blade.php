  <!-- Single Tab Content Start -->
<div class="">
  @if($tab == 'main')
        <div class="tab-pane fade show {{ (Route::currentRouteName() == 'main') ? 'active' : '' }}"
        id="main" role="tabpanel">
          Main details
        </div>
  @endif
</div>
