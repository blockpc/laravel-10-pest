<div>
    <div x-data="{table: @entangle('table')}">
        <div class="page-header">
            <div class="flex space-x-2 items-center">
                <x-heroicon-o-clipboard-list class="w-6 h-6" />
                <span>{{__('todos.titles.list')}}</span>
            </div>
            <div class="flex space-x-2 items-center">
                <button type="button" class="btn-sm btn-default" :title="table ? '{{__('todos.titles.list')}}' : '{{__('common.add')}}' " x-on:click="table = !table, $wire.cancel()">
                    <div class="flex space-x-2" x-show="!table">
                        <x-bx-plus class="w-4 h-4" />
                        <span class="hidden sm:block">{{__('common.add')}}</span>
                    </div>
                    <div class="flex space-x-2" x-show="table">
                        <x-bx-arrow-back class="w-4 h-4" />
                        <span class="hidden sm:block">{{__('todos.titles.list')}}</span>
                    </div>
                </button>
            </div>
        </div>
        <div class="page-content">
            <div class="w-full md:w-1/2 md:mx-auto">
                <div class="grid gap-4" x-show="!table">
                    {{-- List Tasks --}}
                    @foreach ($this->todos as $key => $item)
                    <div class="border-light rounded-md p-2 h-fit" x-data="{list{{$key}}:false}">
                        <div class="grid gap-2">
                            <button type="button" class="btn flex justify-between items-center" x-on:click="list{{$key}}=!list{{$key}}">
                                <span class="">{{$item->name}}</span>
                                <div :class="list{{$key}} ? 'transform rotate-180' : 'transform rotate-0'">
                                    <x-bx-chevron-up class="fill-current h-4 w-4" />
                                </div>
                            </button>
                            <div class="grid gap-2 px-2" x-show="list{{$key}}" x-cloak x-transition>
                                <div class="flex justify-between text-xs italic">
                                    <span>{{__('common.written-by')}}: {{$item->user->name}}</span>
                                    <span>{{$item->created_at->format('Y-m-d H:i')}}</span>
                                </div>
                                <div class="text-xs">{{$item->description}}</div>
                                <ul class="list-disc text-xs ml-4">
                                    @foreach($item->tasks as $value)
                                        <li>{{$value}}</li>
                                    @endforeach
                                </ul>
                                <div class="p-2 space-y-2">
                                    @foreach ($item->messageable as $message)
                                    <div class="flex flex-col space-y-1 p-2 border border-green-500 rounded-md">
                                        <div class="flex justify-between items-center text-xs">
                                            <div class="flex items-center space-x-2">
                                                {{-- <span class="flex items-center px-2 py-1 bg-green-200 dark:bg-green-600 rounded-full">{{ $loop->iteration }}</span> --}}
                                                <span class="italic">{{ $message->user->name }}</span>
                                            </div>
                                            <span class="italic">{{ $message->created_at->format('Y-m-d H:i') }}</span>
                                        </div>
                                        <div class="text-sm px-2">{{$message->message}}</div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="flex justify-end items-center">
                                    <div class="flex space-x-2">
                                        <div class="" x-data="{ showModal : @entangle('open_modal_response') }">
                                            <button type="button" class="btn-sm btn-action text-green-600 dark:text-green-300 flex space-x-2" title="{{__('common.answer')}}" x-on:click="showModal = true">
                                                <x-bx-edit class="w-5 h-5" />
                                            </button>
                                            <x-modals.small class="border-2 border-green-800">
                                                <x-slot name="title">{{__('todos.modal.title')}}</x-slot>
                                                <x-slot name="action">
                                                    <button type="button" wire:click="cancel_message" class="btn btn-warning">{{__('common.cancel')}}</button>
                                                    <button wire:click="message_todo({{$item->id}})" type="button" class="btn btn-primary" id="message_todo_{{$item->id}}">{{__('common.answer')}}</button>
                                                </x-slot>
                                                {{-- description --}}
                                                <x-forms.box-textarea class="flex justify-start items-start text-xs" name="message" title="todos.modal.message" wire:model.lazy="message" id="message_{{$item->id}}" />
                                            </x-modals.small>
                                        </div>
                                        @if ( !$item->read_at )
                                        <button type="button" class="btn-sm btn-action text-blue-600 dark:text-blue-300 flex space-x-2" title="{{__('common.mark-read')}}" wire:click="mark_as_read({{$item->id}})" id="mark_as_read_{{$item->id}}">
                                            <x-bx-check class="w-5 h-5" />
                                        </button>
                                        @endif
                                        <button type="button" class="btn-sm btn-action text-green-600 dark:text-green-300 flex space-x-2" title="{{__('common.edit')}}" wire:click="edit({{$item->id}})" id="edit_{{$item->id}}">
                                            <x-bx-pencil class="w-5 h-5" />
                                        </button>
                                        <button type="button" class="btn-sm btn-action text-red-600 dark:text-red-400 flex space-x-2" title="{{__('common.delete')}}" wire:click="delete_todo({{$item->id}})" id="delete_todo_{{$item->id}}">
                                            <x-bx-x class="w-5 h-5" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div x-show="table" x-cloak>
                    {{-- Form task --}}
                    <form wire:submit.prevent="save">
                        <div class="grid gap-4">
                            <div class="grid gap-4">
                                {{-- name --}}
                                <x-forms.box-text name="todo_name" title="todos.fields.name" wire:model.defer="todo.name" required />
                                {{-- description --}}
                                <x-forms.box-textarea class="flex justify-start items-start text-xs" name="todo_description" title="todos.fields.description" wire:model.defer="todo.description" />
                                {{-- create task --}}
                                <x-forms.box-appends name="todo_task_lists" title="todos.fields.tasks-list" wire:model="task">
                                    <x-slot name="buttons">
                                        <div class="" x-data="{task_id: @entangle('task_id')}">
                                            <button type="button" class="btn-sm btn-info" wire:click="add_task" x-show="!task_id" title="{{__('todos.tasks.add')}}">
                                                <x-bx-plus class="h-5 w-5" />
                                            </button>
                                            <button type="button" class="btn-sm btn-success" wire:click="update_task" x-show="task_id" title="{{__('todos.tasks.update')}}">
                                                <x-bx-pencil class="h-5 w-5" />
                                            </button>
                                        </div>
                                    </x-slot>
                                </x-forms.box-appends>
                                {{-- Task list --}}
                                <div class="flex flex-col space-y-1">
                                    @foreach ($tasks as $task_id => $task)
                                    <div class="flex w-full p-2 dark:bg-gray-800 bg-gray-200 rounded-md">
                                        <div class="flex-1 flex space-x-2 items-center w-full text-sm">
                                            <x-bx-caret-right class="w-3 h-3" />
                                            <span>{{$task}}</span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button type="button" class="btn-sm" wire:click="edit_task({{$task_id}})" title="{{__('todos.tasks.edit')}}">
                                                <x-bx-pencil class="h-5 w-5 text-green-500" />
                                            </button>
                                            <button type="button" class="btn-sm" wire:click="remove_task({{$task_id}})" title="{{__('todos.tasks.remove')}}">
                                                <x-bx-trash class="h-5 w-5 text-red-500" />
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                {{-- buttons --}}
                                <div class="flex justify-end space-x-2">
                                    <button type="button" class="btn-sm btn-action" title="{{__('common.cancel')}}" wire:click="cancel">
                                        {{__('common.cancel')}}
                                    </button>
                                    <button class="btn-sm btn-primary" title="{{__('common.save')}}">
                                        {{__('common.save')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
