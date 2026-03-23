<li>
    <a href="#" class="node">
        <strong>{{ $node['name'] }}</strong><br>
        <small>User ID: {{ $node['user_id'] }}</small>

        <!-- ✅ Hover Box -->
        <div class="hover-box">
            <!-- <p><strong>User ID:</strong> {{ $node['user_id'] }}</p> -->
            <p><strong>Mobile:</strong> {{ $node['mobile'] }}</p>
            <p><strong>Email:</strong> {{ $node['email'] }}</p>
        </div>
    </a>

    @if (!empty($node['children']))
        <ul>
            @foreach ($node['children'] as $child)
                @include('admin.tree_node', ['node' => $child])
            @endforeach
        </ul>
    @endif
</li>
<style>/* TREE CONTAINER */
.tree {
    text-align: center;
}

.tree ul {
    padding-top: 20px;
    position: relative;
    padding-left: 0;
}

.tree li {
    list-style-type: none;
    position: relative;
    padding: 20px 5px 0 5px;
    display: inline-block;
    text-align: center;
}

/* CONNECTOR LINES */
.tree li::before,
.tree li::after {
    content: '';
    position: absolute;
    top: 0;
    right: 50%;
    border-top: 2px solid #ccc;
    width: 50%;
    height: 20px;
}

.tree li::after {
    right: auto;
    left: 50%;
    border-left: 2px solid #ccc;
}

/* REMOVE EXTRA LINES */
.tree li:only-child::before,
.tree li:only-child::after {
    display: none;
}

.tree li:first-child::before {
    border: none;
}

.tree li:last-child::after {
    border: none;
}

/* 🔥 FIX: PERFECT VERTICAL LINE */
.tree ul ul::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    border-left: 2px solid #ccc;
    width: 0;
    height: 100%;
}

/* NODE DESIGN */
.node {
    display: inline-block; /* 🔥 IMPORTANT FIX */
    position: relative;
    text-decoration: none;
    color: #000;
    border: 1px solid #ccc;
    padding: 10px 15px;
    border-radius: 8px;
    background: #fff;
    min-width: 120px;
    transition: 0.3s;
}

.node:hover {
    background: #f5faff;
    border-color: #007bff;
}

/* 🔥 HOVER BOX */
.hover-box {
    display: none;
    position: absolute;
    top: 120%;
    left: 50%;
    transform: translateX(-50%);
    background: #fff;
    border: 1px solid #ddd;
    padding: 8px 10px;
    width: 180px;
    box-shadow: 0 5px 12px rgba(0,0,0,0.15);
    border-radius: 6px;
    z-index: 9999;
    text-align: left;
}

/* SHOW ON HOVER */
.node:hover .hover-box {
    display: block;
}

/* OPTIONAL: SMALL TOOLTIP ARROW */
.hover-box::before {
    content: '';
    position: absolute;
    top: -6px;
    left: 50%;
    transform: translateX(-50%);
    border-width: 6px;
    border-style: solid;
    border-color: transparent transparent #fff transparent;
}</style>