<div class="modal-body">
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Handle</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($roles as $role)
          <tr>
            <th scope="row" class="text-center">{{ $loop->iteration }}</th>
            <td class="text-center">{{ $role->jenis }}</td>
          </tr>
          @endforeach
        </tbody>
    </table>
</div>