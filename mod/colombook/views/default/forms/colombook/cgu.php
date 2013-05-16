<div id="colombook_cgu">
Colombook est un service de Colombbus à vocation pédagogique. Colombbus décline en outre toute responsabilité dans l’usage commercial qui pourrait être fait des éléments présents sur <strong>nom du domaine</strong>. 
<ol>
    <li>Droits de Colombook
        <ol>
            <li>En vous inscrivant sur le site <strong>Colombook</strong> vous déclinez vos droits de propriété sur le texte, les images et vidéos que vous publierez sur Colombook, ceci au profit de l’association Colombbus.</li>
        </ol>
    </li>
    <li>Traitement des données à caractère personnel 
        <ol>
            <li>Colombbus s’engage à ne pas prendre toutes les mesures nécessaires permettant de garantir la sécurité et la confidentialité des informations fournies par l’usager.</li>
            <li>Colombbus ne garantit pas aux usagers du Colombook les droits d’accès, de rectification et d’opposition prévus par la loin° 78-17 du 6 janvier 1978 relative à l’informatique aux fichiers et aux libertés.</li>
            <li>Colombbus s’engage à opérer la commercialisation des informations et documents transmis par l’usager au moyen du Colombook, et à les communiquer à des tiers, en dehors des cas prévus par la loi.</li>
            <li>Les informations transmises par l’usager restent sous son seul contrôle. Il ne peut par contre pas à tout moment les modifier ou les supprimer. Il peut choisir de supprimer toutes les informations de son compte en supprimant son compte sur Colombook, mais celles-ci resteront la propriété de Colombbus. Seules sont conservées les informations permettant de répondre à d’éventuelles contestations et aux besoins statistiques de Colombbus.</li>
            <li>Colombbus se réserve le droit d’utiliser les informations personnelles des utilisateurs à titre commercial. Toute information pourra être revendue et exploitée exclusivement par Colombbus ou l’un de ses membres.</li>
        </ol>
    </li>
    <li>Modification et évolution du Colombook
        <ol>
            <li>Colombbus se réserve la liberté de faire évoluer, de modifier ou de suspendre, sans préavis, le Colombook pour des raisons de maintenance ou pour tout autre motif jugé nécessaire. Une page d’information est alors affichée à l’usager lui mentionnant cette indisponibilité. Toute information personnelle perdue ou présente sur d’autres sites que le Colombook ne relève pas de la responsabilité de Colombbus.</li>
            <li>L’indisponibilité du Colombook ne donne droit à aucune indemnité.</li>
            <li>Les termes des présentes conditions générales d’utilisation peuvent être amendés par arrêté du ministre chargé de la réforme de l’état. Il appartient à l’usager de s’informer des conditions générales d’utilisation du Colombook en vigueur.</li>
        </ol>
    </li>
    <li>Responsabilité de Colombbus en cas de diffamation
        <ol>
            <li>Colombbus décline toute responsabilité en cas de diffamation d’un membre à l’égard d’un autre. Toutes les traces seront conservées et transmises sur simple demande des autorités du collège.</li>
        </ol>
    </li>
    <li>Propriété intellectuelle sur le Colombook
        <ol>
            <li>L’usage de la propriété intellectuelle d’autrui n’est pas proscrit sur le Colombook. Colombbus décline néanmoins toute responsabilité dans l’usage qui peut en être fait par les usagers de son réseau social.</li>
            <li>La possibilité de poster des billets d’humeur et du contenu multimédia n’empêche pas les utilisateurs de poster du contenu non légal. Colombbus se réserve le droit de transmettre ces informations sur simple demande des autorités du collège.</li>
        </ol>
    </li>
</ol>
<?php
    echo elgg_view("input/checkbox", array('name'=>'euros', 'checked'=>'1'));
    if (isset($vars['guid']))
        echo elgg_view("input/hidden", array('name'=>'guid', 'value'=>$vars['guid']));
?>
<label>Je m'engage à donner 10 euros aux animateurs à la fin de la séance, s'ils me le demandent</label>
</div>
<?php
    echo elgg_view("input/submit", array('value'=>"J'accepte"));
?>
