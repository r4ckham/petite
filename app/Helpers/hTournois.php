<?php


namespace Helpers;


class hTournois
{
    const PHASE = "phase";
    const ARBITRE_MAIL = "arbitre_mail";
    const PHASE_MAX = "phase_max";

   public static function getPhase()
    {
        return Session::get(self::PHASE);
    }

   public static function getPhaseMax()
    {
        return Session::get(self::PHASE_MAX);
    }

   public static function getArbitreMail()
    {
        return Session::get(self::ARBITRE_MAIL);
    }

   public static function setPhase($phase)
    {
        Session::set(self::PHASE , $phase);
    }

   public static function setPhaseMax($phaseMax)
    {
        Session::set(self::PHASE_MAX , $phaseMax);
    }

   public static function setArbitreMail($mail)
    {
        Session::set(self::ARBITRE_MAIL , $mail);
    }

}