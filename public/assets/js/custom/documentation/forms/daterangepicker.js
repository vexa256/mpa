(()=>{"use strict";var t={init:function(t){$("#kt_daterangepicker_1").daterangepicker(),$("#kt_daterangepicker_2").daterangepicker({timePicker:!0,startDate:moment().startOf("hour"),endDate:moment().startOf("hour").add(32,"hour"),locale:{format:"M/DD hh:mm A"}}),$("#kt_daterangepicker_3").daterangepicker({singleDatePicker:!0,showDropdowns:!0,minYear:1901,maxYear:parseInt(moment().format("YYYY"),10)},(function(t,e,a){var n=moment().diff(t,"years");alert("You are "+n+" years old!")})),function(t){var e=moment().subtract(29,"days"),a=moment();function n(t,e){$("#kt_daterangepicker_4").html(t.format("MMMM D, YYYY")+" - "+e.format("MMMM D, YYYY"))}$("#kt_daterangepicker_4").daterangepicker({startDate:e,endDate:a,ranges:{Today:[moment(),moment()],Yesterday:[moment().subtract(1,"days"),moment().subtract(1,"days")],"Last 7 Days":[moment().subtract(6,"days"),moment()],"Last 30 Days":[moment().subtract(29,"days"),moment()],"This Month":[moment().startOf("month"),moment().endOf("month")],"Last Month":[moment().subtract(1,"month").startOf("month"),moment().subtract(1,"month").endOf("month")]}},n),n(e,a)}(),$("#kt_daterangepicker_5").daterangepicker()}};KTUtil.onDOMContentLoaded((function(){t.init()}))})();
//# sourceMappingURL=daterangepicker.js.map