<!-- Single Tab Content Start -->
<div class="">
  @if($tab == 'contact')
    <div class="tab-pane fade show {{ (Route::currentRouteName() == 'contact') ? 'active' : '' }}"
      id="contact" role="tabpanel">
      <p>   Tab Panel title: Contact </p>

      <div class="">
        <p> inside component: Contact</p>
      </div>
    </div>
  @endif
</div>
