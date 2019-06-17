var _app = {
    el:"#app",

    data : {
        rencontre : {},
        scoreDom : 0,
        scoreExt : 0,
        enCours : false,
        hasBeenPlayed : false,
        dateRencontre : null,
        diff : {
            hour : 0,
            min : 0,
            sec : 0,
        },
        isDisabled : true,
    },

    mounted : function(){
        this.getInfos();
    },

    methods : {
        chrono : function(){
            var diff = {}                           // Initialisation du retour
            var tmp = new Date() - this.dateRencontre;

            tmp = Math.floor(tmp/1000);             // Nombre de secondes entre les 2 dates
            diff.sec = tmp % 60;                    // Extraction du nombre de secondes
            tmp = Math.floor((tmp-diff.sec)/60);    // Nombre de minutes (partie entière)
            diff.min = tmp % 60;                    // Extraction du nombre de minutes
            tmp = Math.floor((tmp-diff.min)/60);    // Nombre d'heures (entières)
            diff.hour = tmp % 24;                   // Extraction du nombre d'heures
            tmp = Math.floor((tmp-diff.hour)/24);   // Nombre de jours restants
            diff.day = tmp;

            this.diff = diff;
        },
        getInfos : function () {
            var self = this;
            var form = {
                action : "get-rencontre",
            };

            $.post(ajaxUrl , form , function (data) {

                if(data.status != 200){
                    alert(data.error);
                }

                self.rencontre = data.rencontre;

                self.scoreDom = data.rencontre.score_equipe_dom;
                self.scoreExt = data.rencontre.score_equipe_ext;
                self.enCours = (data.rencontre.en_cours == "0") ? false : true;
                self.hasBeenPlayed = (data.rencontre.has_been_played == "0") ? false : true;
                self.dateRencontre = new Date(data.rencontre.date_rencontre);

                if(self.enCours){
                    self.isDisabled = false;
                }



                setInterval(function () {
                    self.chrono();
                }, 1000);

            },"json");
        },

        startMatch : function () {
            var self = this;

            self.enCours = true;

            var form = {
                action : "start-rencontre",
            };

            $.post(ajaxUrl , form , function (data) {

                if(data.status != 200){
                    alert(data.error);
                }

                self.rencontre = data.rencontre;

                self.scoreDom = data.rencontre.score_equipe_dom;
                self.scoreExt = data.rencontre.score_equipe_ext;
                self.enCours = (data.rencontre.en_cours == "0") ? false : true;
                self.hasBeenPlayed = (data.rencontre.has_been_played == "0") ? false : true;
                self.dateRencontre = new Date(data.rencontre.date_rencontre);

                if(self.enCours){
                    self.isDisabled = false;
                }
                
                setInterval(function () {
                    self.chrono();
                }, 1000);

            },"json");
        },

        endMatch : function () {

            var self = this;

            self.enCours = false;
            self.hasBeenPlayed = true;
            self.isDisabled = true;


            var form = {
                action : "end-rencontre",
            };

            $.post(ajaxUrl , form , function (data) {

                if(data.status != 200){
                    alert(data.error);
                }

            },"json");
        },

        scoreMatch : function () {

            if(!this.enCours){
                alert("Match pas en cours !");
            }

            var self = this;
            var form = {
                action : "score-rencontre",
                scoreDom : self.scoreDom,
                scoreExt : self.scoreExt,
            };

            $.post(ajaxUrl , form , function (data) {

                if(data.status != 200){
                    alert(data.error);
                }

            },"json");
        },
    },
}

$(document).ready(function () {
    var app = new Vue(_app);
});