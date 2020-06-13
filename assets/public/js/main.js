;(function($){
  $(document).ready(function(){
    var targetDate = new Date();
    targetDate.setMonth(targetDate.getMonth() + 18)
    targetDate.setDate(1)
    targetDate.setHours(11)
    targetDate.setMinutes(0)
    targetDate.setSeconds(0)
    targetDate.setMilliseconds(0);

    var targetDateStringUTC = targetDate.toISOString()
                                        .replace(':00.000', '');
    var targetDateString = targetDateStringUTC.replace('Z', '');

    var targetLADate = moment.tz(targetDateStringUTC,
                                 'America/Los_Angeles').format();
    var tzLAOffset = targetLADate.substr(-6);
    var targetDateStringOffset = targetDateString.replace('Z', '')
                                     .replace(':00.000', '') +
                                     tzLAOffset;

    var tzOldFormatOffset = targetDateString.substr(-5);
    var targetDateOldFormatString = targetDate.toLocaleDateString() +
                                    ' ' + tzOldFormatOffset;

    var pastDate = new Date();
    pastDate.setMonth(targetDate.getMonth() - 18)
    pastDate.setMinutes(0);
    pastDate.setSeconds(0);
    pastDate.setMilliseconds(0);
    var targetDateStringPast = pastDate.toISOString()
                                       .replace(':00.000', '');
    var nearFutureDate = new Date();
    nearFutureDate.setSeconds(nearFutureDate.getSeconds() + 10);
    nearFutureDate.setMilliseconds(0);
    var nearFutureDateString = nearFutureDate.toISOString()

    $('#counter').countdownCube( {
      target: evcountTranslate.date+'T'+evcountTranslate.time,
      targetTimezone: evcountTranslate.zone,
      cubeSize: evcountTranslate.size,
      background:  evcountTranslate.bg,
      color: evcountTranslate.color,
      
      labelsTranslations: {'year': evcountTranslate.year,
                             'month': evcountTranslate.month,
                             'day': evcountTranslate.day,
                             'hour': evcountTranslate.hour,
                             'minute': evcountTranslate.minute,
                             'second': evcountTranslate.second,
                             },

    showDaysOnly: evcountTranslate.dayonly,
      
        
    } );

  console.log(evcountTranslate.date);
  console.log(evcountTranslate.dayonly)
  
});
})(jQuery);