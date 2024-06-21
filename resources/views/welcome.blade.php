<!DOCTYPE html>
<html>

<head>
    …
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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

        <div x-data="{
            count: 0,
            modelValue: '',
            showModal: false,
            posts: [{
                    id: 1,
                    title: 'first post',
                },
                {
                    id: 2,
                    title: 'second post',
                }
            ]
        }">


            <!-- $data gives access to the x-data within that scope -->
            <!-- $data  will have access to all the x-data within that scope  -->
            <div x-data="{ greeting: 'Hello' }">
                <div x-data="{ name: 'Caleb' }">
                    <button x-on:click="console.log($data)">Check Data </button>
                </div>
            </div>



            <!-- dispatch
             dispatch is used to dispatch an event
             and notify is to listen that

             that notify can be used on any div and we can perform accordingly
                !-->

            <div x-on:notify="alert($event.detail.message)">
                <button x-on:click="$dispatch('notify', { message: 'Hello hamza!' })">
                    Notify
                </button>
            </div>
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

            <input class="border border-red-50" type="text" placeholder="x-model" id="mycustommodel"
                x-model="modelValue">
            <!-- even if we are doing the data-model we can get the value with jquery selector it will have same value as x-model -->
            <span x-text="modelValue">Check live value</span>

            <!--- X-if , to do condionally rendering . works on template  --->
            <template x-if="showModal">
                <p>
                    dhika do

                </p>
            </template>

            <!-- X-for .. ap data declare kro and us p loop chalao --->
            <h1>
                X- loop
            </h1>
            <ul>Posts
                <template x-for="post in posts">
                    <li x-text="post.title"></li>
                </template>
            </ul>
        </div>

        <br>
        <!-- x-Refs .. this is same like vue js refs ..just to pick an element  -->
        <span x-ref="textToAdd"></span>
        <button x-on:click="$refs.textToAdd.innerText = 'hello world'">Add Text with ref</button>

        <br>

        <!-- x-html used to set the innerHTML of a tag  -->
        <p>X-html</p>

        <div x-data="{ username: '<strong>asad </strong>' }">
            Username: <span x-html="username"></span>
        </div>


        <br>
        <br>


        <!-- $el is used to acess the current node -->
        <button x-on:click="$el.innerHTML = 'Hello World!'">Replace me with "Hello World!"</button>


        <!-- $watch is used to watch a value in the data
            we set it with init and then use -->
        <div x-data="{
            counter: 0
        }">
            <button x-on:click="counter++"> ipdate counter</button>
            <div x-init="$watch('counter', value => console.log(value))">

                <!-- whenerver this value will be changed te above watcher will work -->
            </div>
        </div>



        <br>


        <button x-data @click="$store.darkMode.toggle()">Toggle Dark Mode</button>

        ...

        <div x-data :class="$store.darkMode.on && 'bg-black'">
            ...
        </div>


    </div>

    <br>





    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('darkMode', {
                on: false,

                toggle() {
                    this.on = !this.on
                }
            })
        })
    </script>
</body>


</html>
