<div style="
    padding: 50px;
    font-family: system-ui;
">
    @forelse($faq as $questions)
        {!!  $questions->content  !!}
    @empty
        <livewire:footer.footer-empty-state/>
    @endforelse
</div>

