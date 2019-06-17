$.datepicker.setDefaults({
    stepHour: 1,
    stepMinute: 10,
    addSliderAccess: true,
    sliderAccessArgs: { touchonly: false },
});

$.datepicker.setDefaults(
    {
        firstDay: 1,
        altField: "#datepicker",
        closeText: 'Fermer',
        prevText: 'Précédent',
        nextText: 'Suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        weekHeader: 'Sem.',
        dateFormat: 'yy-mm-dd',
    }
);

$.timepicker.regional['fr'] = {
    timeOnlyTitle: 'Temps',
    timeText: 'Horraire',
    hourText: 'Heures',
    minuteText: 'Minutes',
    secondText: 'Secondes',
    millisecText: 'Millisecondes',
    timezoneText: 'timeZone',
    currentText: 'Maintenant',
    closeText: 'Fermer',
    timeFormat: 'HH:mm',
    amNames: ['AM', 'A'],
    pmNames: ['PM', 'P'],
    isRTL: false
};
$.timepicker.setDefaults($.timepicker.regional['fr']);

