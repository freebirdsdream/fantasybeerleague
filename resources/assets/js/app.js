
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
import Datepicker from 'vuejs-datepicker';
 
var season = new Vue({
    el: '#season',
    data: {
        date: new Date($('#date').attr('year'), $('#date').attr('month'), $('#date').attr('day'))
    },
    methods: {
        toggleStyle(event) {
            // make inactive
            if($(event.target).hasClass('active')) {
                $(event.target).addClass('bg-yellow-lighter')
                $(event.target).addClass('hover:bg-yellow');
                $(event.target).removeClass('shadow-inner');
                $(event.target).removeClass('bg-yellow active');
                $($(event.target).children()[0]).attr('checked', false);
            }
            // make active
            else {
                $(event.target).removeClass('bg-yellow-lighter')
                $(event.target).removeClass('hover:bg-yellow');
                $(event.target).addClass('shadow-inner');
                $(event.target).addClass('bg-yellow');
                $(event.target).addClass('active');
                $($(event.target).children()[0]).attr('checked', true);
            }
        },
        toggleOption(event) {
            var option = $(event.target).attr('option');
            $('.' + option).attr('checked', false);
            $('.importance-option').addClass('bg-yellow-lighter')
            $('.importance-option').addClass('hover:bg-yellow');
            $('.importance-option').removeClass('shadow-inner');
            $('.importance-option').removeClass('bg-yellow active');
            $('.importance-option').removeClass('active');

            // make inactive
            $(event.target).removeClass('bg-yellow-lighter')
            $(event.target).removeClass('hover:bg-yellow');
            $(event.target).addClass('shadow-inner');
            $(event.target).addClass('bg-yellow');
            $(event.target).addClass('active');
            $($(event.target).children()[0]).attr('checked', true);
        },
        addCustomStyle(event) {
            var value = $('#customStyle').val();
            if(value) {
                var newStyle = '<div class="m-1 p-4 border border-yellow-lighter shadown-inner active rounded-lg bg-yellow" title="' + value + '">\n' +
                                    value + '\n' +
                                    '<input type=\'checkbox\' class="hidden" name="styles[]" value="' + value + '" checked />\n' +
                                '</div>';
                $('#styles').append(newStyle);
            }
        }
    },
    components: {
    	Datepicker
    },
});