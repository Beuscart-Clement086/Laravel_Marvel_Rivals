<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Personnage;

/**
 * Remplit les cosmétiques des personnages à partir du wiki Fandom :
 * costumes, animations MVP, emotes, sprays, nameplates + histoire (Personality).
 *
 * Les images pointent vers le CDN du wiki (hotlink) : elles ne sont PAS
 * téléchargées localement. Les vues détectent les URL externes (http).
 *
 * Idempotent (updateOrCreate). Facile à étendre : un bloc par personnage.
 */
class CosmeticsSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            'Adam Warlock' => [

                'histoire' => "Adam Warlock a été créé pour être un humain parfait : brillant, puissant et au cœur pur. Depuis ses tout premiers souvenirs, il lutte contre les attentes placées en lui et contre la notion même de ce que signifie réellement être « parfait ». Sa personnalité reflète ce conflit intérieur : il est noble, contemplatif et souvent accablé par le poids du destin. Warlock réfléchit longuement avant d'agir, guidé par un sens moral puissant et par le désir de comprendre ce qui est bien et mal à l'échelle cosmique. Cependant, son sentiment d'avoir une mission peut parfois l'isoler ; il perçoit l'univers en termes philosophiques et peine à se lier avec ceux qui mènent des vies ordinaires et imparfaites. Avant sa résurrection, Adam était une figure sombre, presque tragique. Dans sa quête désespérée d'un sens à sa vie, il a trouvé du réconfort en devenant une force du bien. Profondément introspectif, il s'interroge sans cesse sur sa place dans l'univers, sur les desseins de ses créateurs et sur sa propre nature. Il cherche l'équilibre, non seulement dans l'univers, mais aussi en lui-même. Cette attitude contemplative fait de lui un meneur naturel et une boussole morale pour les autres, mais le rend aussi sujet à des crises existentielles et à des moments de doute lorsqu'il croit que ses actes risquent de briser la paix qu'il s'efforce de préserver.\n\nAdam est dépeint comme un génie philosophe, austère et distant, qui lutte avec sa double nature — le « bien » parfait et le mal chaotique — tout en se comportant avec une sérénité presque imperturbable. C'est un être noble et vertueux, mais aussi assez arrogant. Il s'exprime généralement d'une manière très formelle et prolixe, usant abondamment d'allitérations pour souligner la conscience qu'il a de son pouvoir et de son destin, ce qui donne une impression de sagesse bien au-delà de son âge. La vision étendue de Warlock façonne son cadre moral singulier, le poussant à prendre des décisions inattendues qui favorisent l'équilibre global du monde plutôt que le bien ou le mal traditionnels. Il manifeste aussi de la compassion et un instinct protecteur envers ceux qu'il aime, comme les Gardiens de la Galaxie ou les êtres innocents envers lesquels il se sent responsable. Lors d'une interaction en jeu avec Wolverine, il évoque sa part la plus sombre, Magus, une version de lui-même corrompue par le pouvoir et le fanatisme. Bien qu'on n'ait pas encore vu ni révélé la transformation d'Adam en Magus, il est connu pour être prêt à absorber Magus en lui, malgré le risque de corruption, afin de sauver les autres et le cosmos.",

                'capacites' => [
                    ['nom' => 'Magie Quantique',       'touche' => 'Clic gauche', 'type' => 'Attaque normale',  'degats' => 60,   'rechargement' => null, 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/2/20/Quantum_Magic_Icon.png/revision/latest?cb=20250915155213',      'description' => "Tir hitscan qui lance de rapides traits d'énergie pour blesser les ennemis."],
                    ['nom' => 'Amas Cosmique',         'touche' => 'Clic droit',  'type' => 'Attaque spéciale', 'degats' => 38,   'rechargement' => null, 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/e/ed/Cosmic_Cluster_Icon.png/revision/latest?cb=20250915040844',     'description' => "Charge le bâton puis libère plusieurs traits d'énergie (jusqu'à 5 projectiles)."],
                    ['nom' => "Flux Vital de l'Avatar",'touche' => 'E',           'type' => 'Capacité',         'degats' => null, 'rechargement' => null, 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/6/6c/Avatar_Life_Stream_Icon.png/revision/latest?cb=20250915040839', 'description' => "Énergie de soin rebondissante touchant jusqu'à deux alliés (2 charges)."],
                    ['nom' => "Lien d'Âme",            'touche' => 'Maj',         'type' => 'Capacité',         'degats' => null, 'rechargement' => 40,   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/3/34/Soul_Bond_Icon.png/revision/latest?cb=20250915040833',         'description' => "Crée un lien entre Adam et les alliés proches, répartissant équitablement les dégâts subis."],
                    ['nom' => 'Résurrection Karmique',  'touche' => 'Q',           'type' => 'Ultime',           'degats' => null, 'rechargement' => null, 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/4/45/Karmic_Revival_Icon.png/revision/latest?cb=20250915040921',       'description' => "Crée une zone quantique qui ressuscite automatiquement les alliés tombés à l'intérieur."],
                    ['nom' => 'Cocon Régénérateur',    'touche' => 'Passif',      'type' => 'Passif',           'degats' => null, 'rechargement' => 105,  'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/9/95/Regenerative_Cocoon_Icon.png/revision/latest?cb=20250915040851', 'description' => "Permet à Adam de réapparaître depuis un cocon à un endroit choisi."],
                ],

                'costumes' => [
                    ['nom' => 'Magus',            'rarete' => 'Épique',     'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/0/07/CosInfo_-_Adam_Warlock_Magus_Icon.png/revision/latest?cb=20260110032337'],
                    ['nom' => 'Sorcier Cosmique', 'rarete' => 'Légendaire', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/7/7a/CosInfo_-_Adam_Warlock_Cosmic_Warlock_Icon.png/revision/latest?cb=20260110020954'],
                    ['nom' => 'Tribunal Vivant',  'rarete' => 'Épique',     'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/f/f3/CosInfo_-_Adam_Warlock_Living_Tribunal_Icon.png/revision/latest?cb=20260319234338'],
                ],

                'mvp' => [
                    ['nom' => 'Arcane Sombre',     'rarete' => 'Épique',     'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/9/93/Adam_Warlock_MVP_-_Dark_Arcanum_Full.gif/revision/latest?cb=20260121211503'],
                    ['nom' => 'Voyage Cosmique',   'rarete' => 'Légendaire', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/0/03/Adam_Warlock_MVP_-_Cosmic_Voyage_Full.gif/revision/latest?cb=20260121210917'],
                    ['nom' => 'Autorité Absolue',  'rarete' => 'Épique',     'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/7/7b/Adam_Warlock_MVP_-_Absolute_Authority_Full.gif/revision/latest?cb=20260327102601'],
                ],

                'emotes' => [
                    ['nom' => 'Guidance Galactique',  'rarete' => 'Épique', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/1/16/Adam_Warlock_Emote_-_Galactic_Guidance_Full.gif/revision/latest?cb=20260111005231'],
                    ['nom' => 'Innocence Renaissante','rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/a/a9/Adam_Warlock_Emote_-_Innocence_Reborn_Full.gif/revision/latest?cb=20251227221549'],
                    ['nom' => 'Ombres du Passé',      'rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/5/54/Adam_Warlock_Emote_-_Shadows_of_the_Past_Full.gif/revision/latest?cb=20260327102552'],
                    ["nom" => "L'Éclat Appelle",      'rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/c/c4/Adam_Warlock_Emote_-_Brilliance_Beckons_Full.gif/revision/latest?cb=20251227220407'],
                    ['nom' => 'Force Souveraine',     'rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/e/e8/Adam_Warlock_Emote_-_Sovereign_Strength_Full.gif/revision/latest?cb=20251227221414'],
                    ['nom' => 'Exorcisme Divin',      'rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/a/aa/Adam_Warlock_Emote_-_Divine_Exorcism_Full.gif/revision/latest?cb=20251227221054'],
                    ['nom' => 'Prends un Siège',      'rarete' => 'Épique', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/7/7a/Adam_Warlock_Emote_-_Take_A_Seat_Full.gif/revision/latest?cb=20260111004839'],
                    ['nom' => 'Défaut',               'rarete' => 'Défaut', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/0/09/Adam_Warlock_Emote_-_DEFAULT_Full.gif/revision/latest?cb=20251227220800'],
                ],

                'sprays' => [
                    ['nom' => 'Sorcier Cosmique',              'rarete' => 'Rare', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/5/57/Spray_Icon_-_Cosmic_Warlock.png/revision/latest?cb=20260108211524'],
                    ['nom' => 'Âme de Sang',                   'rarete' => 'Rare', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/9/9b/Spray_Icon_-_Blood_Soul.png/revision/latest?cb=20250911184208'],
                    ['nom' => 'Tribunal Vivant',               'rarete' => 'Rare', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/e/ef/Spray_Icon_-_Living_Tribunal.png/revision/latest?cb=20260320014901'],
                    ['nom' => 'Magus',                         'rarete' => 'Rare', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/2/2f/Spray_Icon_-_Magus.png/revision/latest?cb=20251114060913'],
                    ['nom' => 'Gardiens de la Galaxie Vol. 3', 'rarete' => 'Rare', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/4/49/Spray_Icon_-_Guardians_of_the_Galaxy%2C_Vol.3_Adam_Warlock.png/revision/latest?cb=20250116162501'],
                    ['nom' => 'Avatar Immortel',               'rarete' => 'Rare', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/a/a0/Spray_Icon_-_Immortal_Avatar.png/revision/latest?cb=20250522120729'],
                    ['nom' => 'Roi en Blanc',                  'rarete' => 'Rare', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/5/5b/Spray_Icon_-_King_in_White.png/revision/latest?cb=20250706025906'],
                    ["nom" => "Emblème d'Adam Warlock",        'rarete' => 'Rare', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/c/ce/Spray_Icon_-_Adam_Warlock_Emblem.png/revision/latest?cb=20250125031152'],
                ],

                'nameplates' => [
                    ['nom' => 'Sorcier Cosmique',              'rarete' => 'Épique', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/1/1b/Adam_Warlock_Full_Nameplate_-_Cosmic_Warlock.gif/revision/latest?cb=20260403233405'],
                    ['nom' => 'Âme de Sang',                   'rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/7/75/Adam_Warlock_Full_Nameplate_-_Blood_Soul.png/revision/latest?cb=20250123010743'],
                    ['nom' => 'Tribunal Vivant',               'rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/c/c0/Adam_Warlock_Full_Nameplate_-_Living_Tribunal.png/revision/latest?cb=20260320110412'],
                    ['nom' => 'Magus',                         'rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/5/56/Adam_Warlock_Full_Nameplate_-_Magus.png/revision/latest?cb=20251114052423'],
                    ['nom' => 'Gardiens de la Galaxie Vol. 3', 'rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/8/84/Adam_Warlock_Full_Nameplate_-_Guardians_of_the_Galaxy_Vol._3.png/revision/latest?cb=20250125032735'],
                    ['nom' => 'Avatar Immortel',               'rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/a/ad/Adam_Warlock_Full_Nameplate_-_Immortal_Avatar.png/revision/latest?cb=20250522121751'],
                    ['nom' => 'Roi en Blanc',                  'rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/5/5f/Adam_Warlock_Full_Nameplate_-_King_in_White.png/revision/latest?cb=20250706030329'],
                ],
            ],

            'Angela' => [

                'vie' => 450,

                'histoire' => "Angela est décrite comme une déesse guerrière puissante, fière et déterminée. Elle a un sens aigu du devoir, envers son héritage mais aussi envers ce qu'elle estime juste. Autonome et indépendante, elle a été élevée comme une chasseuse et formée par les anges de Heven à combattre, commander et survivre. Décrite comme sûre d'elle, arrogante et prompte à la colère, elle embrasse le combat et affronte de grands adversaires — armées et monstres — même quand les chances sont contre elle. C'est une combattante redoutable qui affronte les difficultés par le raisonnement, la stratégie et une confiance inébranlable. Contrairement à beaucoup, Angela ne s'appuie pas sur l'autorité ou la tradition pour se guider ; elle se fie à son intuition et prend ses propres décisions, traçant une voie qui reflète ses idéaux et son propre code d'honneur.\n\nBien qu'elle soit l'une des enfants d'Odin, Angela méprise profondément son père. Durant la majeure partie de sa vie, elle a ignoré qui étaient ses vrais parents ; pendant des années, elle a vu Odin comme un roi-dieu despotique plutôt que comme son père. En découvrant la vérité, elle se sent trahie, en colère et dégoûtée par le mensonge qu'a été sa vie, ainsi que par l'échec d'Odin à la sauver alors qu'elle n'était qu'un nourrisson durant la guerre entre Asgard et Heven. Malgré sa nature guerrière, Angela est très protectrice et compatissante envers ceux qu'elle aime, comme sa jeune sœur Laussa, et ses amis, dont les Gardiens de la Galaxie, dont elle a fait partie un temps. Sous son extérieur endurci par les batailles, elle est réfléchie et empathique, attachée à la loyauté et aux liens avec ceux en qui elle a confiance. Prudente et sur ses gardes, elle est aussi curieuse et prête à affronter l'injustice : sa force est équilibrée par l'empathie et une clarté morale.",

                'capacites' => [
                    ['nom' => "Lance d'Ichor",          'touche' => 'Clic gauche', 'type' => 'Attaque normale', 'degats' => 45,   'rechargement' => null, 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/4/44/Spear_of_Ichors_Icon.png', 'description' => "Frappe en avant avec votre lance, infligeant des dégâts qui augmentent avec la Charge d'Attaque. À pleine charge, projette les ennemis en l'air."],
                    ['nom' => "Haches d'Ichor",         'touche' => 'Clic gauche', 'type' => 'Attaque normale', 'degats' => 30,   'rechargement' => null, 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/4/4c/Axes_of_Ichors_Icon.png', 'description' => "Combo de quatre frappes avec les haches jumelles ; la quatrième propulse Angela vers l'avant."],
                    ['nom' => 'Posture de Bouclier',    'touche' => 'Clic droit',  'type' => 'Capacité',        'degats' => null, 'rechargement' => null, 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/b/b3/Shielded_Stance_Icon.png', 'description' => "Transforme les Ichors en bouclier et gagne de la Charge d'Attaque en absorbant les dégâts."],
                    ['nom' => "Charge de l'Assassin",   'touche' => 'Maj',         'type' => 'Capacité',        'degats' => null, 'rechargement' => 6,    'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/f/f4/Assassin%27s_Charge_Icon.png', 'description' => "Charge accélérée, immunisée contre les projections ; les ennemis touchés de plein fouet sont emportés."],
                    ['nom' => 'Jugement Divin',         'touche' => 'E',           'type' => 'Capacité',        'degats' => 30,   'rechargement' => 12,   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/1/19/Divine_Judgement_Icon.png', 'description' => "Plonge au sol, passe aux haches et crée une Zone de Jugement Divin (vitesse accrue et points de vie bonus pour les alliés)."],
                    ['nom' => "Ascension de l'Aile-Lame",'touche' => 'E',          'type' => 'Capacité',        'degats' => null, 'rechargement' => null, 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/c/c8/Wingblade_Ascent_Icon.png', 'description' => "S'élève dans les airs et repasse à la Lance d'Ichor (vol libre)."],
                    ['nom' => 'Châtiment de Heven',     'touche' => 'Q',           'type' => 'Ultime',          'degats' => 100,  'rechargement' => null, 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/f/f6/Heven%27s_Retribution_Icon.png', 'description' => "Ultime : projette la lance enrubannée ; à l'impact, les rubans entravent les ennemis proches. Angela peut bondir vers la lance pour créer une Zone de Jugement Divin."],
                    ['nom' => 'Envol Séraphique',       'touche' => 'Passif',      'type' => 'Passif',          'degats' => null, 'rechargement' => null, 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/6/6d/Seraphic_Soar_Icon.png', 'description' => "Passif : plane librement dans les airs ; un vol continu augmente la Charge d'Attaque."],
                ],

                'costumes' => [
                    ['nom' => 'Skuld 2099',            'rarete' => 'Légendaire', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/7/78/Angela_Skuld_2099_LoC_Icon.png'],
                    ['nom' => 'As de Pique',           'rarete' => 'Épique',     'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/e/ee/Angela_Ace_of_Spades_LoC_Icon.png'],
                    ["nom" => "La Belle Fille d'Odin", 'rarete' => 'Épique',     'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/8/85/Angela_Odin%27s_Beautiful_Daughter_LoC_Icon.png'],
                    ['nom' => 'Ange de Doom',          'rarete' => 'Rare',       'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/c/c4/Angela_Doom_Angel_LoC_Icon.png'],
                ],

                'mvp' => [
                    ['nom' => 'Briser les Chaînes',       'rarete' => 'Légendaire', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/a/a7/Angela_MVP_-_Escape_the_Shackles_Full.gif/revision/latest?cb=20260225171532'],
                    ['nom' => 'Frappe du Tigre Radieux',  'rarete' => 'Épique',     'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/8/87/Angela_MVP_-_Radiant_Tiger_Strike_Full.gif/revision/latest?cb=20260225171737'],
                    ["nom" => "Tornade de l'As",          'rarete' => 'Épique',     'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/1/18/Angela_MVP_-_Ace_Tornado_Full.gif/revision/latest?cb=20260225170226'],
                ],

                'emotes' => [
                    ['nom' => 'Pour Heven !',    'rarete' => 'Épique', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/f/fe/Angela_Emote_-_For_Heven%21_Full.gif/revision/latest?cb=20251228110221'],
                    ['nom' => 'Tigre Accroupi',  'rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/3/30/Angela_Emote_-_Crouching_Tiger_Full.gif/revision/latest?cb=20251227202952'],
                    ['nom' => 'Fantôme du Poker', 'rarete' => 'Rare',  'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/7/7b/Angela_Emote_-_Poker_Phantom_Full.gif/revision/latest?cb=20260131005442'],
                    ['nom' => 'Perce-Sorcière',  'rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/a/a3/Angela_Emote_-_Witchpiercer_Full.gif/revision/latest?cb=20260327103906'],
                    ['nom' => 'Défaut',          'rarete' => 'Défaut', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/4/48/Angela_Emote_-_DEFAULT_Full.gif/revision/latest?cb=20251228110318'],
                ],

                'sprays' => [
                    ['nom' => 'Skuld 2099',            'rarete' => 'Rare', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/2/28/Spray_Icon_-_Skuld_2099.png/revision/latest?cb=20250907131203'],
                    ["nom" => "La Belle Fille d'Odin", 'rarete' => 'Rare', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/d/d1/Spray_Icon_-_Odin%27s_Beautiful_Daughter.png/revision/latest?cb=20251114061128'],
                    ['nom' => 'As de Pique',           'rarete' => 'Rare', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/0/06/Spray_Icon_-_Ace_of_Spades.png/revision/latest?cb=20260129122442'],
                    ['nom' => 'Ange de Doom',          'rarete' => 'Rare', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/1/18/Spray_Icon_-_Doom_Angel.png/revision/latest?cb=20260320014931'],
                    ["nom" => "Emblème d'Angela",      'rarete' => 'Rare', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/3/33/Spray_Icon_-_Angela_Emblem.png/revision/latest?cb=20250907131008'],
                ],

                'nameplates' => [
                    ['nom' => 'Skuld 2099',            'rarete' => 'Épique', 'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/9/9a/Angela_Full_Nameplate_-_Skuld_2099.gif/revision/latest?cb=20260407094106'],
                    ["nom" => "La Belle Fille d'Odin", 'rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/8/82/Angela_Full_Nameplate_-_Odin%27s_Beautiful_Daughter.png/revision/latest?cb=20251114052708'],
                    ['nom' => 'As de Pique',           'rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/3/3e/Angela_Full_Nameplate_-_Ace_of_Spades.png/revision/latest?cb=20260129121457'],
                    ['nom' => 'Ange de Doom',          'rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/7/72/Angela_Full_Nameplate_-_Doom_Angel.png/revision/latest?cb=20260320100124'],
                    ['nom' => 'Angela',                'rarete' => 'Rare',   'image' => 'https://static.wikia.nocookie.net/marvel-rivals/images/a/ac/Angela_Full_Nameplate_-_Angela.png/revision/latest?cb=20250907124454'],
                ],
            ],

        ];

        foreach ($data as $nomPerso => $infos) {
            $personnage = Personnage::where('nom', $nomPerso)->first();

            if (!$personnage) {
                $this->command->warn("Personnage introuvable : {$nomPerso} (ignoré).");
                continue;
            }

            // Histoire (Personality) en français + points de vie officiels
            if (!empty($infos['histoire'])) {
                $personnage->description = $infos['histoire'];
            }
            if (!empty($infos['vie'])) {
                $personnage->vie = $infos['vie'];
            }
            $personnage->save();

            // Réinitialise les cosmétiques de ce personnage (évite les doublons
            // lorsque les noms changent, ex. traduction en français).
            $personnage->costumes()->delete();
            $personnage->animations()->delete();
            $personnage->cosmetiques()->delete();
            $personnage->capacites()->delete();

            // Capacités (hors team-up) — caractéristiques basiques uniquement
            foreach ($infos['capacites'] ?? [] as $cap) {
                $personnage->capacites()->create($cap);
            }

            // Costumes
            foreach ($infos['costumes'] ?? [] as $c) {
                $personnage->costumes()->updateOrCreate(
                    ['nom' => $c['nom']],
                    ['rarete' => $c['rarete'], 'image' => $c['image'], 'video' => null]
                );
            }

            // Animations MVP
            foreach ($infos['mvp'] ?? [] as $a) {
                $personnage->animations()->updateOrCreate(
                    ['nom' => $a['nom']],
                    ['rarete' => $a['rarete'], 'image' => $a['image'], 'video' => null]
                );
            }

            // Cosmétiques (emotes / sprays / nameplates)
            $types = ['emotes' => 'emote', 'sprays' => 'spray', 'nameplates' => 'nameplate'];
            foreach ($types as $cle => $type) {
                foreach ($infos[$cle] ?? [] as $item) {
                    $personnage->cosmetiques()->updateOrCreate(
                        ['type' => $type, 'nom' => $item['nom']],
                        ['rarete' => $item['rarete'], 'image' => $item['image']]
                    );
                }
            }
        }
    }
}
