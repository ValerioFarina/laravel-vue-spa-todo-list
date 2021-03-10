<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo list</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div id="app" v-cloak>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="mt-3 mb-3 text-center">
                            Todo list
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-8 offset-lg-2">
                        <div id="add-item" class="mb-4 text-center d-flex justify-content-center">
                            <input v-model="newItem" @keyup.enter="addItem()" placeholder="Add new item" class="mr-1"/>
                            <i @click="addItem()" class="fas fa-plus-square btn btn-success"></i>
                        </div>
                        <div id="items-container">
                            <ul v-if="items.length" class="list-unstyled border border-primary">
                                <li v-for="item in items" class="p-2 d-flex justify-content-between aling-items-center border-bottom border-bottom-primary">
                                    <div class="item">
                                        <input @change="checkItem(item.id)" type="checkbox" v-model="item.completed" />
                                        <input type="text" v-model="currentItem.name" v-if="currentItem.id !== undefined && currentItem.id === item.id" @change="changeItem()" @keyup.enter="selectItem(item.id, item.name)">
                                        <span :class="{ 'checked' : item.completed }" v-else>
                                            @{{ item.name }}
                                        </span>
                                    </div>
                                    <div class="delete-item">
                                        <i @click="selectItem(item.id, item.name)" class="fas fa-edit btn"></i>
                                        <i @click="deleteItem(item.id)" class="fas fa-trash-alt btn"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
