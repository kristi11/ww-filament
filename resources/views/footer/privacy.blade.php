<div style="
    padding: 50px;
    font-family: system-ui;
">
    @forelse($privacy as $data)
        {!!  $data->content  !!}
    @empty
        <livewire:footer.footer-empty-state/>
    @endforelse
</div>

