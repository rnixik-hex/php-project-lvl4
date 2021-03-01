<?php
/** @var \App\Models\TaskStatus[] $taskStatuses */
?>
@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h1 class="mt-5 mb-3">{{ __('Task statuses') }}</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tr>
                    <th>{{ __('Name') }}</th>
                </tr>
                <?php foreach ($taskStatuses as $taskStatus) : ?>
                    <tr>
                        <td><?= $taskStatus->name ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
@endsection
