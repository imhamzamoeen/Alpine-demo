<!DOCTYPE html>
<html>

<head>
    …
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <style>
        /* to hide the content until alpine js is loaded.. if we don't use this then the hidden div with alpine shows a kind of glitch like first rendered and then disappers */
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body>
    <div class="container w-full h-full flex">

        <div x-data="{ count: 0, modelValue: '' }">
            <!-- to start a value with alpine js we use x-data:{} inside we have key value
                and that value is only accessible inside that scope of the div -->

            <button x-bind:class="count > 2 ? 'text-green-950' : 'text-red-900'"
                class=" btn btn-block btn-primary border text-black background" x-on:click="count++">Add Value
                to the count </button>
            <!-- only show the div if the count value is greater than zero -->
            <!-- x-transition for smooth transition form shown to hidden -->

            <div x-cloak x-show="count > 0" x-transition>
                <h1>
                    the result of the alpine data is
                    <span>
                        <!-- x-bind is used to bind hmtl attribute through alpind javascript
                            like if count would be greater than 2 then add text-red color else text-blue
                            we can add any html attribute like value placeholder other as well
                        -->
                        <span x-text="count"></span>
                    </span>
                </h1>
                <!-- x-effect is execute a script whenever a value (give) is changed-
                    You can think of it as a watcher where you don't have to specify what property to watch, it will watch all properties used within it.
                    i used count in it so whenever count is changed it will be logged
                -->
                <div x-effect="console.log(count)"></div>
                <!-- x-model is like two way binding .. we declare a proprty and then it can be assigned to a input tag -->

            </div>
            <br>

            <input class="border border-red-50" type="text" placeholder="x-model" x-model="modelValue">
            <span x-text="modelValue">Check live value</span>
        </div>

    </div>
    </div>

</body>

</html>
