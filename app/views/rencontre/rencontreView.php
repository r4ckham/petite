<?php
?>

<div class="container" id="app" style="margin-top: 30px">
    <div class="panel panel-default">
        <div class="panel-heading">
            Rencontre :
        </div>
        <div class="panel-body">
            <div class="form-group">
                <span>Status :</span>
                <span v-if="enCours == true">
                    Match En Cours
                    <div id="countdown">
                        <span>Chrono :</span>
                        <span>{{diff.hour}}</span> Heure
                        <span>{{diff.min}}</span> Minutes
                        <span>{{diff.sec}}</span> Secondes
                    </div>
                </span>
                <span v-if="!enCours && !hasBeenPlayed"> Match à determiner </span>
                <span v-if="hasBeenPlayed"> Match Déjà Joué</span>
            </div>

            <hr>

            <div class="form-group">
                <label>{{rencontre.equipe_dom}}</label><br>
                <el-input-number v-model="scoreDom" :step="1" :min="0" @change="scoreMatch"></el-input-number><br>
                <label>{{rencontre.equipe_ext}}</label><br>
                <el-input-number v-model="scoreExt" :step="1" :min="0" @change="scoreMatch"></el-input-number>
            </div>

            <hr>

            <div class="form-group">
                <div v-if="!enCours && !hasBeenPlayed">
                    <button class="btn btn-success" @click="startMatch" id="startMatch" >Demarer le match</button>
                </div>

                <div v-if="enCours && !hasBeenPlayed">
                    <button class="btn btn-success" @click="endMatch">Finir le match</button>
                </div>
            </div>

            <div class="form-group"></div>
        </div>
    </div>
</div>

<script>
    var ajaxUrl = "<?= DIR . \Helpers\Url::URL_RENCONTRE_AJAX?>";
</script>
