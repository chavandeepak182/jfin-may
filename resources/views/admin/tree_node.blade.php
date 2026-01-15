
<li>
    <a href="#" class="node">
        <strong>{{ $node['name'] }}</strong><br>
        <small>User ID: {{ $node['user_id'] }}</small>
    </a>

    @if (!empty($node['children']))
        <ul>
            @foreach ($node['children'] as $child)
                @include('admin.tree_node', ['node' => $child])
            @endforeach
        </ul>
    @endif
</li>
