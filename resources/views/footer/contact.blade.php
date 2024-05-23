<div style="
    padding: 50px;
    font-family: system-ui;
    text-align: center;
">
    @forelse($contact as $data)
        {!!  $data->content  !!}
    @empty
        <livewire:footer.footer-empty-state/>
    @endforelse
</div>

