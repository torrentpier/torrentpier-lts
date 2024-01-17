# 📖 Change Log

## [v2.1.5-2024.02 [Final v2]](https://github.com/torrentpier/torrentpier-lts/tree/v2.1.5-2024.01) (2024-01-03)
[Full Changelog](https://github.com/torrentpier/torrentpier-lts/compare/v2.1.5-2023.10-HotFix...v2.1.5-2024.02)

- Release v2.1.5-2024.02 🎉
- Some improvements in default template
- Fixed void function result used
- Feature to ban specific torrent clients
- Get SERVER_NAME variable for cron tasks
- Improved handling errors while uploading
- Hide vote button in poll if user already voted
- Fixed Undefined index: to_id when trying to delete empty forum category
- Fixed HTTP 500 while cron running in server-side
- Fixed auth(): empty $f_access
- Fixed broken captcha check on login.php
- Fixed broken sorting in group.php
- Fixed extensions issue
- Restored unused functionality "Block torrent editing with certain status"
- Some fixes for Thumbnails functionality
- Some fixes for Ban functionality
- Some enhancements for dl.php
- Some other changes / improvements
- Some reported bugfixes
- Updated translations

## [v2.1.5-2023.10-HotFix [Final]](https://github.com/torrentpier/torrentpier-lts/tree/v2.1.5-2023.10-HotFix) (2023-11-20)
[Full Changelog](https://github.com/torrentpier/torrentpier-lts/compare/v2.1.5-2023.10...v2.1.5-2023.10-HotFix)

**Merged pull requests:**

- Release v2.1.5-2023.10-HotFix 🎉
- Fixed announce-list indexes ordering [\#339](https://github.com/torrentpier/torrentpier-lts/pull/339) ([belomaxorka](https://github.com/belomaxorka))
- Fixed $bb_cfg['file_id_ext'] ordering [\#338](https://github.com/torrentpier/torrentpier-lts/pull/338) ([belomaxorka](https://github.com/belomaxorka))
- Normalizing announce-list [\#337](https://github.com/torrentpier/torrentpier-lts/pull/337) ([belomaxorka](https://github.com/belomaxorka))
- Fixed announcer-list issue [\#335](https://github.com/torrentpier/torrentpier-lts/pull/335), [\#336](https://github.com/torrentpier/torrentpier-lts/pull/336) ([belomaxorka](https://github.com/belomaxorka))
- Don't create empty announce-list dict, if ann_urls are empty [\#334](https://github.com/torrentpier/torrentpier-lts/pull/334) ([belomaxorka](https://github.com/belomaxorka), [kovalensky](https://github.com/kovalensky))
- Improve code for retracker addition [\#333](https://github.com/torrentpier/torrentpier-lts/pull/333) ([belomaxorka](https://github.com/belomaxorka), [kovalensky](https://github.com/kovalensky))
- Don't use main announce url inside announce-list [\#332](https://github.com/torrentpier/torrentpier-lts/pull/332) ([belomaxorka](https://github.com/belomaxorka), [kovalensky](https://github.com/kovalensky))
- Don't check for announce-list while adding new urls [9db4517](https://github.com/torrentpier/torrentpier-lts/commit/9db45170674b1971203527218826fdc4cbbd72c5) ([belomaxorka](https://github.com/belomaxorka), [kovalensky](https://github.com/kovalensky))
- Security measures [\#330](https://github.com/torrentpier/torrentpier-lts/pull/330), [\#331](https://github.com/torrentpier/torrentpier-lts/pull/331) ([belomaxorka](https://github.com/belomaxorka), [kovalensky](https://github.com/kovalensky))
- Fix for html entities being displayed in magnet links [\#329](https://github.com/torrentpier/torrentpier-lts/pull/329) ([belomaxorka](https://github.com/belomaxorka), [kovalensky](https://github.com/kovalensky))
- Fixed a bug causing inability to view file contents for some torrents [\#328](https://github.com/torrentpier/torrentpier-lts/pull/328) ([belomaxorka](https://github.com/belomaxorka), [kovalensky](https://github.com/kovalensky))
- Updated UTF8 class up to v2.3.1 [ed2220e](https://github.com/torrentpier/torrentpier-lts/commit/ed2220e6f37e7bf98ab17c46c7ec4422a36ad387) ([belomaxorka](https://github.com/belomaxorka))
- Block uploading more than one torrent file [33bb006](https://github.com/torrentpier/torrentpier-lts/commit/33bb006965cb22350624c6e89c4d5b39fd93c087) ([belomaxorka](https://github.com/belomaxorka))
- Fixed: Moderators can't see self IP addresses [39d4b14](https://github.com/torrentpier/torrentpier-lts/commit/39d4b14f7a118223b952a98eecf7fe1625fc20b2) ([belomaxorka](https://github.com/belomaxorka))
- Fixed undefined tpl variable SHOW_GROUP_MEMBERSHIP [8e96648](https://github.com/torrentpier/torrentpier-lts/commit/8e9664822c0a4daa514192cdaefa361425d86b29) ([belomaxorka](https://github.com/belomaxorka))
- Fixed broken avatar ajax action for users [48ea82e](https://github.com/torrentpier/torrentpier-lts/commit/48ea82e4ce706026dc4fd63e8f9153da21d38071) ([belomaxorka](https://github.com/belomaxorka))
- Unset debug cookies if SQL_DEBUG disabled
- Unset debug cookie if user not in dbg_users array
- Updated translations
- Added missing translations
- Some other changes / improvements

## [v2.1.5-2023.10 [Final]](https://github.com/torrentpier/torrentpier-lts/tree/v2.1.5-2023.10) (2023-11-04)
[Full Changelog](https://github.com/torrentpier/torrentpier-lts/compare/v2.1.5-2023.09...v2.1.5-2023.10)

**Merged pull requests:**

- Release v2.1.5-2023.10 🎉
- Added ability to debug ajax_die() calls
- Added missing migration file (lts03-user_birthday.php)
- Check $tpl_vars['QUESTION'] in print_confirmation() [5bff794](https://github.com/torrentpier/torrentpier-lts/commit/5bff794ac21035768e2b5f4ece716ec5d897aa94) ([belomaxorka](https://github.com/belomaxorka))
- Some fixes in admin_attach_cp.php
- Fixed undefined $lang['PREVIOUS'] [c0769be](https://github.com/torrentpier/torrentpier-lts/commit/c0769be368aaac27f9e7e26b49980d1b25fbab84) ([belomaxorka](https://github.com/belomaxorka))
- Fixed broken letter marking in memberlist.php [6be1eb9](https://github.com/torrentpier/torrentpier-lts/commit/6be1eb994a377e75ae8a901e47ae41ecacec98c8) ([belomaxorka](https://github.com/belomaxorka))
- Fixed error while trying to delete posts by bot [8ee06f8](https://github.com/torrentpier/torrentpier-lts/commit/8ee06f87ed5b31ad327b6e159789fa016a6c4a72), [df5ed81](https://github.com/torrentpier/torrentpier-lts/commit/df5ed816bfee5d68d87c7c34e5f14045e87e1b9d) ([belomaxorka](https://github.com/belomaxorka))
- Added the ability to add additional announce URLs into torrent files
- Added check $bb_cfg['magnet_links_enabled'] in create_magnet()
- Added $lang['BT_UNREGISTERED_ALREADY'] lang key
- SQL: Increase speed_up & speed_down type limits
- Use strip_tags() for message in prompt_for_confirm()
- Use strip_tags() for error message in ajax_die()
- Use lang variable $lang['BT_REG_FAIL'] instead of text
- Fixed percentage calculation for SQL debug
- Minor improvements [\#297](https://github.com/torrentpier/torrentpier-lts/pull/297), [\#298](https://github.com/torrentpier/torrentpier-lts/pull/298), [\#300](https://github.com/torrentpier/torrentpier-lts/pull/300), [\#301](https://github.com/torrentpier/torrentpier-lts/pull/301), [\#302](https://github.com/torrentpier/torrentpier-lts/pull/302), [\#303](https://github.com/torrentpier/torrentpier-lts/pull/303), [\#305](https://github.com/torrentpier/torrentpier-lts/pull/305), [\#306](https://github.com/torrentpier/torrentpier-lts/pull/306), [\#307](https://github.com/torrentpier/torrentpier-lts/pull/307), [\#310](https://github.com/torrentpier/torrentpier-lts/pull/310), [\#312](https://github.com/torrentpier/torrentpier-lts/pull/312), [\#313](https://github.com/torrentpier/torrentpier-lts/pull/313), [\#315](https://github.com/torrentpier/torrentpier-lts/pull/315), [\#316](https://github.com/torrentpier/torrentpier-lts/pull/316), [\#317](https://github.com/torrentpier/torrentpier-lts/pull/317), [\#319](https://github.com/torrentpier/torrentpier-lts/pull/319), [\#321](https://github.com/torrentpier/torrentpier-lts/pull/321), [\#322](https://github.com/torrentpier/torrentpier-lts/pull/322), [\#323](https://github.com/torrentpier/torrentpier-lts/pull/323), [\#324](https://github.com/torrentpier/torrentpier-lts/pull/324) ([belomaxorka](https://github.com/belomaxorka))

## [v2.1.5-2023.09](https://github.com/torrentpier/torrentpier-lts/tree/v2.1.5-2023.09) (2023-10-04)
[Full Changelog](https://github.com/torrentpier/torrentpier-lts/compare/v2.1.5-2023.08-HotFix...v2.1.5-2023.09)

**Merged pull requests:**

- Release v2.1.5-2023.09 🎉
- Use humn_size() for AVATAR_EXPLAIN [\#295](https://github.com/torrentpier/torrentpier-lts/pull/295) ([belomaxorka](https://github.com/belomaxorka))
- Added missing template var in group.php [\#294](https://github.com/torrentpier/torrentpier-lts/pull/294) ([belomaxorka](https://github.com/belomaxorka))
- Prevent infinity user adding into group [\#292](https://github.com/torrentpier/torrentpier-lts/pull/292) ([belomaxorka](https://github.com/belomaxorka))
- Maked configurable email visibility for everybody [\#291](https://github.com/torrentpier/torrentpier-lts/pull/291) ([belomaxorka](https://github.com/belomaxorka))
- Corrected translations in topic templates [\#289](https://github.com/torrentpier/torrentpier-lts/pull/289) ([belomaxorka](https://github.com/belomaxorka))
- ACP: Changed extensions sorting [\#288](https://github.com/torrentpier/torrentpier-lts/pull/288) ([belomaxorka](https://github.com/belomaxorka))
- Fix $mail_to format (Adding missing ">" at end) [\#284](https://github.com/torrentpier/torrentpier-lts/pull/284) ([belomaxorka](https://github.com/belomaxorka), dchistyakov)
- Added missing EXCLUDED_USERS_CSV in tr_stats.php [\#283](https://github.com/torrentpier/torrentpier-lts/pull/283) ([belomaxorka](https://github.com/belomaxorka))
- Added support 7z archives [\#282](https://github.com/torrentpier/torrentpier-lts/pull/282) ([belomaxorka](https://github.com/belomaxorka))
- Added support bmp images in BBCode [\#279](https://github.com/torrentpier/torrentpier-lts/pull/279) ([belomaxorka](https://github.com/belomaxorka))
- Added support webp images in BBCode [\#278](https://github.com/torrentpier/torrentpier-lts/pull/278) ([belomaxorka](https://github.com/belomaxorka))
- Enhancements for text editor [\#277](https://github.com/torrentpier/torrentpier-lts/pull/277) ([belomaxorka](https://github.com/belomaxorka))
- Added missing !defined('BB_ROOT') check [\#274](https://github.com/torrentpier/torrentpier-lts/pull/274) ([belomaxorka](https://github.com/belomaxorka))
- Exclude padding files [\#260](https://github.com/torrentpier/torrentpier-lts/pull/260) ([belomaxorka](https://github.com/belomaxorka), [kovalensky](https://github.com/kovalensky))
- Added missing translation in admin_ug_auth [\#254](https://github.com/torrentpier/torrentpier-lts/pull/254) ([belomaxorka](https://github.com/belomaxorka))
- Support for IDN domains [\#252](https://github.com/torrentpier/torrentpier-lts/pull/252) ([belomaxorka](https://github.com/belomaxorka), [kovalensky](https://github.com/kovalensky))
- Fixed cache directory auto-creating with SQLite [\#247](https://github.com/torrentpier/torrentpier-lts/pull/247) ([belomaxorka](https://github.com/belomaxorka))
- Minor improvements [\#245](https://github.com/torrentpier/torrentpier-lts/pull/245), [\#246](https://github.com/torrentpier/torrentpier-lts/pull/246), [\#248](https://github.com/torrentpier/torrentpier-lts/pull/248), [\#249](https://github.com/torrentpier/torrentpier-lts/pull/249), [\#250](https://github.com/torrentpier/torrentpier-lts/pull/250), [\#251](https://github.com/torrentpier/torrentpier-lts/pull/251), [\#253](https://github.com/torrentpier/torrentpier-lts/pull/253), [\#255](https://github.com/torrentpier/torrentpier-lts/pull/255), [\#256](https://github.com/torrentpier/torrentpier-lts/pull/256), [\#257](https://github.com/torrentpier/torrentpier-lts/pull/257), [\#258](https://github.com/torrentpier/torrentpier-lts/pull/258), [\#259](https://github.com/torrentpier/torrentpier-lts/pull/259), [\#261](https://github.com/torrentpier/torrentpier-lts/pull/261), [\#262](https://github.com/torrentpier/torrentpier-lts/pull/262), [\#263](https://github.com/torrentpier/torrentpier-lts/pull/263), [\#264](https://github.com/torrentpier/torrentpier-lts/pull/264), [\#265](https://github.com/torrentpier/torrentpier-lts/pull/265), [\#266](https://github.com/torrentpier/torrentpier-lts/pull/266), [\#267](https://github.com/torrentpier/torrentpier-lts/pull/267), [\#268](https://github.com/torrentpier/torrentpier-lts/pull/268), [\#269](https://github.com/torrentpier/torrentpier-lts/pull/269), [\#270](https://github.com/torrentpier/torrentpier-lts/pull/270), [\#271](https://github.com/torrentpier/torrentpier-lts/pull/271), [\#273](https://github.com/torrentpier/torrentpier-lts/pull/273), [\#275](https://github.com/torrentpier/torrentpier-lts/pull/275), [\#280](https://github.com/torrentpier/torrentpier-lts/pull/280), [\#281](https://github.com/torrentpier/torrentpier-lts/pull/281), [\#287](https://github.com/torrentpier/torrentpier-lts/pull/287), [\#290](https://github.com/torrentpier/torrentpier-lts/pull/290), [\#293](https://github.com/torrentpier/torrentpier-lts/pull/293), [\#296](https://github.com/torrentpier/torrentpier-lts/pull/296) ([belomaxorka](https://github.com/belomaxorka))

## [v2.1.5-2023.08-HotFix](https://github.com/torrentpier/torrentpier-lts/tree/v2.1.5-2023.08-HotFix) (2023-09-17)
[Full Changelog](https://github.com/torrentpier/torrentpier-lts/compare/v2.1.5-2023.08...v2.1.5-2023.08-HotFix)

**Merged pull requests:**

- Release v2.1.5-2023.08-HotFix 🎉
- Minor improvements [\#235](https://github.com/torrentpier/torrentpier-lts/pull/235), [\#236](https://github.com/torrentpier/torrentpier-lts/pull/236), [\#237](https://github.com/torrentpier/torrentpier-lts/pull/237), [\#238](https://github.com/torrentpier/torrentpier-lts/pull/238), [\#239](https://github.com/torrentpier/torrentpier-lts/pull/239), [\#240](https://github.com/torrentpier/torrentpier-lts/pull/240), [\#241](https://github.com/torrentpier/torrentpier-lts/pull/241), [\#242](https://github.com/torrentpier/torrentpier-lts/pull/242), [\#243](https://github.com/torrentpier/torrentpier-lts/pull/243), [\#244](https://github.com/torrentpier/torrentpier-lts/pull/244) ([belomaxorka](https://github.com/belomaxorka))

## [v2.1.5-2023.08](https://github.com/torrentpier/torrentpier-lts/tree/v2.1.5-2023.08) (2023-09-04)
[Full Changelog](https://github.com/torrentpier/torrentpier-lts/compare/v2.1.5-2023.07...v2.1.5-2023.08)

**Merged pull requests:**

- Release v2.1.5-2023.08 🎉
- Captcha improvements [\#229](https://github.com/torrentpier/torrentpier-lts/pull/229) ([belomaxorka](https://github.com/belomaxorka))
- Show renamed topic actions in log actions [\#227](https://github.com/torrentpier/torrentpier-lts/pull/227) ([belomaxorka](https://github.com/belomaxorka))
- Show set/unset downloaded actions in log actions [\#226](https://github.com/torrentpier/torrentpier-lts/pull/226) ([belomaxorka](https://github.com/belomaxorka))
- Show pin & unpin actions in log actions [\#225](https://github.com/torrentpier/torrentpier-lts/pull/225) ([belomaxorka](https://github.com/belomaxorka))
- Minor improvements [\#215](https://github.com/torrentpier/torrentpier-lts/pull/215), [\#216](https://github.com/torrentpier/torrentpier-lts/pull/216), [\#217](https://github.com/torrentpier/torrentpier-lts/pull/217), [\#218](https://github.com/torrentpier/torrentpier-lts/pull/218), [\#221](https://github.com/torrentpier/torrentpier-lts/pull/221), [\#222](https://github.com/torrentpier/torrentpier-lts/pull/222), [\#224](https://github.com/torrentpier/torrentpier-lts/pull/224), [\#228](https://github.com/torrentpier/torrentpier-lts/pull/228), [\#234](https://github.com/torrentpier/torrentpier-lts/pull/234) ([belomaxorka](https://github.com/belomaxorka))

## [v2.1.5-2023.07](https://github.com/torrentpier/torrentpier-lts/tree/v2.1.5-2023.07) (2023-08-04)
[Full Changelog](https://github.com/torrentpier/torrentpier-lts/compare/v2.1.5-2023.06...v2.1.5-2023.07)

**Merged pull requests:**

- Release v2.1.5-2023.07 🎉
- Fix RFC 1918 RegExp [\#210](https://github.com/torrentpier/torrentpier-lts/pull/210) ([belomaxorka](https://github.com/belomaxorka))
- Maked max smilies in PM configurable [\#211](https://github.com/torrentpier/torrentpier-lts/pull/211) ([belomaxorka](https://github.com/belomaxorka))
- Increase post_text & privmsgs_text limits [\#213](https://github.com/torrentpier/torrentpier-lts/pull/213) ([belomaxorka](https://github.com/belomaxorka))
- Minor improvements [\#212](https://github.com/torrentpier/torrentpier-lts/pull/212) ([belomaxorka](https://github.com/belomaxorka))

## [v2.1.5-2023.06](https://github.com/torrentpier/torrentpier-lts/tree/v2.1.5-2023.06) (2023-07-04)
[Full Changelog](https://github.com/torrentpier/torrentpier-lts/compare/v2.1.5-2023.05...v2.1.5-2023.06)

**Merged pull requests:**

- Release v2.1.5-2023.06 🎉
- Fixed broken sessions [\#205](https://github.com/torrentpier/torrentpier-lts/pull/205) ([belomaxorka](https://github.com/belomaxorka))
- Fixed broken skype widget in user profile [\#203](https://github.com/torrentpier/torrentpier-lts/pull/203) ([belomaxorka](https://github.com/belomaxorka))
- Redirect to viewprofile.php if profile.php hasn't arguments [\#202](https://github.com/torrentpier/torrentpier-lts/pull/202) ([belomaxorka](https://github.com/belomaxorka))
- Show smilies in post for guests [\#196](https://github.com/torrentpier/torrentpier-lts/pull/196) ([belomaxorka](https://github.com/belomaxorka))
- Added showing PM counter in page title [\#193](https://github.com/torrentpier/torrentpier-lts/pull/193) ([belomaxorka](https://github.com/belomaxorka))
- Corrected translations [\#183](https://github.com/torrentpier/torrentpier-lts/pull/183) ([belomaxorka](https://github.com/belomaxorka))
- Fixed $bb_cfg['pm_days_keep'] [\#180](https://github.com/torrentpier/torrentpier-lts/pull/180) ([belomaxorka](https://github.com/belomaxorka))
- IP storage bugfix [\#177](https://github.com/torrentpier/torrentpier-lts/pull/177) ([belomaxorka](https://github.com/belomaxorka))
- Minor improvements [\#172](https://github.com/torrentpier/torrentpier-lts/pull/172), [\#175](https://github.com/torrentpier/torrentpier-lts/pull/175), [\#176](https://github.com/torrentpier/torrentpier-lts/pull/176), [\#178](https://github.com/torrentpier/torrentpier-lts/pull/178), [\#179](https://github.com/torrentpier/torrentpier-lts/pull/179), [\#181](https://github.com/torrentpier/torrentpier-lts/pull/181), [\#187](https://github.com/torrentpier/torrentpier-lts/pull/187), [\#192](https://github.com/torrentpier/torrentpier-lts/pull/192), [\#194](https://github.com/torrentpier/torrentpier-lts/pull/194), [\#195](https://github.com/torrentpier/torrentpier-lts/pull/195), [\#199](https://github.com/torrentpier/torrentpier-lts/pull/199), [\#200](https://github.com/torrentpier/torrentpier-lts/pull/200), [\#201](https://github.com/torrentpier/torrentpier-lts/pull/201), [\#208](https://github.com/torrentpier/torrentpier-lts/pull/208), [\#209](https://github.com/torrentpier/torrentpier-lts/pull/209) ([belomaxorka](https://github.com/belomaxorka))
- Fixed empty user search box [\#171](https://github.com/torrentpier/torrentpier-lts/pull/171) ([belomaxorka](https://github.com/belomaxorka))
- Added some placeholders for input fields [\#173](https://github.com/torrentpier/torrentpier-lts/pull/173) ([belomaxorka](https://github.com/belomaxorka))

## [v2.1.5-2023.05](https://github.com/torrentpier/torrentpier-lts/tree/v2.1.5-2023.05) (2023-06-04)
[Full Changelog](https://github.com/torrentpier/torrentpier-lts/compare/v2.1.5-2023.04...v2.1.5-2023.05)

**Merged pull requests:**

- Release v2.1.5-2023.05 🎉
- Minor improvements [\#169](https://github.com/torrentpier/torrentpier-lts/pull/169), [\#170](https://github.com/torrentpier/torrentpier-lts/pull/170) ([belomaxorka](https://github.com/belomaxorka))

## [v2.1.5-2023.04](https://github.com/torrentpier/torrentpier-lts/tree/v2.1.5-2023.04) (2023-05-04)
[Full Changelog](https://github.com/torrentpier/torrentpier-lts/compare/v2.1.5-2023.03...v2.1.5-2023.04)

**Merged pull requests:**

- Release v2.1.5-2023.04 🎉
- Display source language if no user language variable [\#113](https://github.com/torrentpier/torrentpier-lts/pull/113) ([belomaxorka](https://github.com/belomaxorka))
- Torrent file content sort fix [\#119](https://github.com/torrentpier/torrentpier-lts/pull/119) ([belomaxorka](https://github.com/belomaxorka))
- Fix release template editor [\#120](https://github.com/torrentpier/torrentpier-lts/pull/120) ([belomaxorka](https://github.com/belomaxorka))
- Fix some notices in admin panel reported by BugSnag [\#121](https://github.com/torrentpier/torrentpier-lts/pull/121) ([belomaxorka](https://github.com/belomaxorka))
- Fix magnet link passkey creation for new users [\#122](https://github.com/torrentpier/torrentpier-lts/pull/122) ([belomaxorka](https://github.com/belomaxorka))
- Make activate key length configurable [\#125](https://github.com/torrentpier/torrentpier-lts/pull/125) ([belomaxorka](https://github.com/belomaxorka))
- Make user_newpasswd length configurable [\#126](https://github.com/torrentpier/torrentpier-lts/pull/126) ([belomaxorka](https://github.com/belomaxorka))
- Make password length configurable [\#127](https://github.com/torrentpier/torrentpier-lts/pull/127) ([belomaxorka](https://github.com/belomaxorka))
- Increase mysql types limits [\#128](https://github.com/torrentpier/torrentpier-lts/pull/128) ([belomaxorka](https://github.com/belomaxorka))
- Added installed extensions check [\#129](https://github.com/torrentpier/torrentpier-lts/pull/129) ([belomaxorka](https://github.com/belomaxorka))
- Make sql log file name configurable [\#130](https://github.com/torrentpier/torrentpier-lts/pull/130) ([belomaxorka](https://github.com/belomaxorka))
- Enhanced https check [\#131](https://github.com/torrentpier/torrentpier-lts/pull/131), [\#132](https://github.com/torrentpier/torrentpier-lts/pull/132) ([belomaxorka](https://github.com/belomaxorka))
- Added ability to configure sphinx debug [\#137](https://github.com/torrentpier/torrentpier-lts/pull/137) ([belomaxorka](https://github.com/belomaxorka))
- Redundant pagination, mysql 5.7+ issue [\#140](https://github.com/torrentpier/torrentpier-lts/pull/140) ([belomaxorka](https://github.com/belomaxorka))
- Added Freeleech [\#143](https://github.com/torrentpier/torrentpier-lts/pull/143) ([belomaxorka](https://github.com/belomaxorka))
- Added some new torrent clients into sidebar [\#146](https://github.com/torrentpier/torrentpier-lts/pull/146) ([belomaxorka](https://github.com/belomaxorka))
- Fixed issue with atom feed [\#147](https://github.com/torrentpier/torrentpier-lts/pull/147) ([belomaxorka](https://github.com/belomaxorka))
- Added theme exists check [\#149](https://github.com/torrentpier/torrentpier-lts/pull/149) ([belomaxorka](https://github.com/belomaxorka))
- Use XS_TPL_PREFIX instead of 'tpl_' [\#150](https://github.com/torrentpier/torrentpier-lts/pull/150) ([belomaxorka](https://github.com/belomaxorka))
- Use constants instead of string literals [\#151](https://github.com/torrentpier/torrentpier-lts/pull/151), [\#160](https://github.com/torrentpier/torrentpier-lts/pull/160) ([belomaxorka](https://github.com/belomaxorka))
- Sync language (html dir) with latest sources [\#152](https://github.com/torrentpier/torrentpier-lts/pull/152) ([belomaxorka](https://github.com/belomaxorka))
- Updated UK lang icons [\#155](https://github.com/torrentpier/torrentpier-lts/pull/155) ([belomaxorka](https://github.com/belomaxorka))
- Minor fixes [\#124](https://github.com/torrentpier/torrentpier-lts/pull/124), [\#133](https://github.com/torrentpier/torrentpier-lts/pull/133), [\#135](https://github.com/torrentpier/torrentpier-lts/pull/135), [\#136](https://github.com/torrentpier/torrentpier-lts/pull/136), [\#139](https://github.com/torrentpier/torrentpier-lts/pull/139), [\#142](https://github.com/torrentpier/torrentpier-lts/pull/142), [\#144](https://github.com/torrentpier/torrentpier-lts/pull/144), [\#145](https://github.com/torrentpier/torrentpier-lts/pull/145), [\#148](https://github.com/torrentpier/torrentpier-lts/pull/148), [\#153](https://github.com/torrentpier/torrentpier-lts/pull/153), [\#154](https://github.com/torrentpier/torrentpier-lts/pull/154), [\#156](https://github.com/torrentpier/torrentpier-lts/pull/156), [\#157](https://github.com/torrentpier/torrentpier-lts/pull/157), [\#158](https://github.com/torrentpier/torrentpier-lts/pull/158), [\#159](https://github.com/torrentpier/torrentpier-lts/pull/159), [\#162](https://github.com/torrentpier/torrentpier-lts/pull/162), [\#163](https://github.com/torrentpier/torrentpier-lts/pull/163), [\#164](https://github.com/torrentpier/torrentpier-lts/pull/164), [\#165](https://github.com/torrentpier/torrentpier-lts/pull/165), [\#166](https://github.com/torrentpier/torrentpier-lts/pull/166) ([belomaxorka](https://github.com/belomaxorka))

## [v2.1.5-2023.03](https://github.com/torrentpier/torrentpier-lts/tree/v2.1.5-2023.03) (2023-04-04)
[Full Changelog](https://github.com/torrentpier/torrentpier-lts/compare/v2.1.5-2023.03...main)

**Merged pull requests:**

- Release v2.1.5-2023.03 🎉
- Fixed broken user search in admin_groups [\#1](https://github.com/torrentpier/torrentpier-lts/pull/1) ([belomaxorka](https://github.com/belomaxorka))
- Fix broken ajax [\#2](https://github.com/torrentpier/torrentpier-lts/pull/2) ([belomaxorka](https://github.com/belomaxorka))
- Various bug fixes described on the forum [\#3](https://github.com/torrentpier/torrentpier-lts/pull/3) ([belomaxorka](https://github.com/belomaxorka))
- Simplified make_rand_str function [\#4](https://github.com/torrentpier/torrentpier-lts/pull/4) ([belomaxorka](https://github.com/belomaxorka))
- Tidy deprecated option merge-spans remove [\#5](https://github.com/torrentpier/torrentpier-lts/pull/5) ([belomaxorka](https://github.com/belomaxorka))
- Incorrect case close operators [\#6](https://github.com/torrentpier/torrentpier-lts/pull/6) ([belomaxorka](https://github.com/belomaxorka))
- Poster birthday with no birthday date fix [\#8](https://github.com/torrentpier/torrentpier-lts/pull/8) ([belomaxorka](https://github.com/belomaxorka))
- New external service for look up IP address [\#9](https://github.com/torrentpier/torrentpier-lts/pull/9) ([belomaxorka](https://github.com/belomaxorka))
- Add check lang [\#10](https://github.com/torrentpier/torrentpier-lts/pull/10) ([belomaxorka](https://github.com/belomaxorka))
- Fixed array multi sorting [\#11](https://github.com/torrentpier/torrentpier-lts/pull/11) ([belomaxorka](https://github.com/belomaxorka))
- Added $bb_cfg['emailer_disabled'] check [\#12](https://github.com/torrentpier/torrentpier-lts/pull/12) ([belomaxorka](https://github.com/belomaxorka))
- Updated jQuery up to v1.12.4 [\#13](https://github.com/torrentpier/torrentpier-lts/pull/13) ([belomaxorka](https://github.com/belomaxorka))
- Fixed broken avatar ajax action for users [\#14](https://github.com/torrentpier/torrentpier-lts/pull/14) ([belomaxorka](https://github.com/belomaxorka))
- Added passkey check in show_bt_userdata [\#15](https://github.com/torrentpier/torrentpier-lts/pull/15) ([belomaxorka](https://github.com/belomaxorka))
- Fixed getting online info from cache [\#16](https://github.com/torrentpier/torrentpier-lts/pull/16) ([belomaxorka](https://github.com/belomaxorka))
- Incorrect log file rotation regex [\#77](https://github.com/torrentpier/torrentpier-lts/pull/77) ([belomaxorka](https://github.com/belomaxorka))
- Fixed typo in file cache [\#78](https://github.com/torrentpier/torrentpier-lts/pull/78) ([belomaxorka](https://github.com/belomaxorka))
- Fixed undefined is_moz [\#80](https://github.com/torrentpier/torrentpier-lts/pull/80) ([belomaxorka](https://github.com/belomaxorka))
- Fixed Static methods invocation via '->'. [\#81](https://github.com/torrentpier/torrentpier-lts/pull/81) ([belomaxorka](https://github.com/belomaxorka))
- Fixed broken user_birthday applying ajax [\#82](https://github.com/torrentpier/torrentpier-lts/pull/82) ([belomaxorka](https://github.com/belomaxorka))
- Insecure 'uniqid(...)' usage (Insufficient Entropy Vulnerability). [\#83](https://github.com/torrentpier/torrentpier-lts/pull/83) ([belomaxorka](https://github.com/belomaxorka))
- Fixed Binary-unsafe 'fopen(...)' usage [\#84](https://github.com/torrentpier/torrentpier-lts/pull/84) ([belomaxorka](https://github.com/belomaxorka))
- New check PHP ver method [\#85](https://github.com/torrentpier/torrentpier-lts/pull/85) ([belomaxorka](https://github.com/belomaxorka))
- Replaced banned message to native [\#86](https://github.com/torrentpier/torrentpier-lts/pull/86) ([belomaxorka](https://github.com/belomaxorka))
- Fixed broken log copy [\#87](https://github.com/torrentpier/torrentpier-lts/pull/87) ([belomaxorka](https://github.com/belomaxorka))
- Added missing default statement in switch case [\#88](https://github.com/torrentpier/torrentpier-lts/pull/88) ([belomaxorka](https://github.com/belomaxorka))
- Added ability to hide ajax loading alert [\#90](https://github.com/torrentpier/torrentpier-lts/pull/90) ([belomaxorka](https://github.com/belomaxorka))
- Added optional parameter in $valid_actions [AJAX] [\#91](https://github.com/torrentpier/torrentpier-lts/pull/91) ([belomaxorka](https://github.com/belomaxorka))
- Added SQLite3 installed check [\#92](https://github.com/torrentpier/torrentpier-lts/pull/92) ([belomaxorka](https://github.com/belomaxorka))
- Fixed broken predicting birthday year [\#93](https://github.com/torrentpier/torrentpier-lts/pull/93) ([belomaxorka](https://github.com/belomaxorka))
- Fixed broken sql log selecting in debug-panel [\#95](https://github.com/torrentpier/torrentpier-lts/pull/95) ([belomaxorka](https://github.com/belomaxorka))
- Added link to forum in admin_forumauth.tpl [\#96](https://github.com/torrentpier/torrentpier-lts/pull/96) ([belomaxorka](https://github.com/belomaxorka))
- Fix multiple variable cleanup in private messaging [\#97](https://github.com/torrentpier/torrentpier-lts/pull/97) ([belomaxorka](https://github.com/belomaxorka))
- Removed copyright check [\#99](https://github.com/torrentpier/torrentpier-lts/pull/99) ([belomaxorka](https://github.com/belomaxorka))
- Default value for user_birthday causes exception on user password change [\#100](https://github.com/torrentpier/torrentpier-lts/pull/100) ([belomaxorka](https://github.com/belomaxorka))
- Fixed broken SQLite3 cache [\#102](https://github.com/torrentpier/torrentpier-lts/pull/102) ([belomaxorka](https://github.com/belomaxorka))
- Added word censor in some cases [\#104](https://github.com/torrentpier/torrentpier-lts/pull/104) ([belomaxorka](https://github.com/belomaxorka))
- Unique topic page title [\#105](https://github.com/torrentpier/torrentpier-lts/pull/105) ([belomaxorka](https://github.com/belomaxorka))
- Updated ZF up to 2.4.13 [\#106](https://github.com/torrentpier/torrentpier-lts/pull/106) ([belomaxorka](https://github.com/belomaxorka))
- Added replenishable status [\#107](https://github.com/torrentpier/torrentpier-lts/pull/107) ([belomaxorka](https://github.com/belomaxorka))
- Auto language removal [\#108](https://github.com/torrentpier/torrentpier-lts/pull/108) ([belomaxorka](https://github.com/belomaxorka))
- Minor adjustments in sql dump [\#109](https://github.com/torrentpier/torrentpier-lts/pull/109) ([belomaxorka](https://github.com/belomaxorka))
- Fix default users language in dump [\#110](https://github.com/torrentpier/torrentpier-lts/pull/110) ([belomaxorka](https://github.com/belomaxorka))
- Fix some bugs with MySQL strict mode [\#111](https://github.com/torrentpier/torrentpier-lts/pull/111) ([belomaxorka](https://github.com/belomaxorka))
- Fixed broken sitemap sending [\#112](https://github.com/torrentpier/torrentpier-lts/pull/112) ([belomaxorka](https://github.com/belomaxorka))
- Minor fixes [\#89](https://github.com/torrentpier/torrentpier-lts/pull/89), [\#94](https://github.com/torrentpier/torrentpier-lts/pull/94), [\#98](https://github.com/torrentpier/torrentpier-lts/pull/98), [\#101](https://github.com/torrentpier/torrentpier-lts/pull/101), [\#103](https://github.com/torrentpier/torrentpier-lts/pull/103) ([belomaxorka](https://github.com/belomaxorka))
