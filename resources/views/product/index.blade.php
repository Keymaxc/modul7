<tbody>
    @forelse ($data as $cast)
    <tr>
        <th scope="row">{{ $loop ->iteration }}</th>
        <th>
            <img src="{{ asset('img/' . $cat->image) }}" alt=""widht="100px" height="50px">
        </th>
        <td>{{ $cat->tittle }}</td>
        <td>{{ $cat->category->tittle->category }}</td>
        <td>{{ $cat->harga }}</td>
        <td>
            <a href="{{route('admin.product.edit', $cat->id) }}" class="btn btn-warning btn-sm">
                <i class ="fa fa-edit"></i>
            Edit</a>
            <a href="{{ rouete('admin.product.edit', $cat->id) }}" class ="btn btn-warning btn-sm ">
                <i class = "fa fa-trash"></i>
            Hapus</a>
        </td>
    </tr>
    @empty
        <tr>
            <th colspan="6" class="text-center"> Not Found</th>
        </tr>
    @endforelse
</tbody>