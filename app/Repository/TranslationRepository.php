<?php

namespace App\Repository;
use Doctrine\ORM\EntityRepository;

class TranslationRepository extends EntityRepository
{
    /**
     * @param $langCode
     * @param $key
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTranslationValue($langCode, $key)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('x.value')
            ->from($this->_entityName, 'x')
            ->leftJoin("x.key", 'k')
            ->leftJoin("x.lang", 'l')
            ->where($qb->expr()->in('k.title', "'$key'"))
            ->andWhere($qb->expr()->in('l.code', "'$langCode'"));
        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param $langCode
     * @return mixed
     */
    public function getLanguageTranslated($langCode)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('key.title, translations.value')
            ->from($this->_entityName, 'key')
            ->leftJoin('key.translations', 'translations')
            ->leftJoin('translations.lang', 'language')

            ->andWhere($qb->expr()->eq('language.code', "'$langCode'"));

        $result = $qb->getQuery()->getResult();
        if (empty($result)) {
            return false;
        }

        $array = [];
        foreach ($result as $titleAndValue) {
            $array[$titleAndValue['title']] = $titleAndValue['value'];
        }

        return $array;
    }

}
