/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
import $ from"jquery";import NProgress from"nprogress";import Notification from"@typo3/backend/notification.js";import AjaxRequest from"@typo3/core/ajax/ajax-request.js";var ExtensionManagerUpdateIdentifier;!function(e){e.extensionTable="#terTable",e.terUpdateAction=".update-from-ter",e.pagination=".pagination-wrap",e.splashscreen=".splash-receivedata",e.terTableWrapper="#terTableWrapper .table"}(ExtensionManagerUpdateIdentifier||(ExtensionManagerUpdateIdentifier={}));class ExtensionManagerUpdate{initializeEvents(){$(ExtensionManagerUpdateIdentifier.terUpdateAction).each(((e,a)=>{const t=$(a),n=t.attr("action");t.attr("action","#"),t.on("submit",(()=>(this.updateFromTer(n,!0),!1))),this.updateFromTer(n,!1)}))}updateFromTer(e,a){a&&(e+="&forceUpdateCheck=1"),$(ExtensionManagerUpdateIdentifier.terUpdateAction).addClass("extensionmanager-is-hidden"),$(ExtensionManagerUpdateIdentifier.extensionTable).hide(),$(ExtensionManagerUpdateIdentifier.splashscreen).addClass("extensionmanager-is-shown"),$(ExtensionManagerUpdateIdentifier.terTableWrapper).addClass("extensionmanager-is-loading"),$(ExtensionManagerUpdateIdentifier.pagination).addClass("extensionmanager-is-loading");let t=!1;NProgress.start(),new AjaxRequest(e).get().then((async e=>{const a=await e.resolve();a.errorMessage.length&&Notification.error(TYPO3.lang["extensionList.updateFromTerFlashMessage.title"],a.errorMessage,10);const n=$(ExtensionManagerUpdateIdentifier.terUpdateAction+" .extension-list-last-updated");n.text(a.timeSinceLastUpdate),n.attr("title",TYPO3.lang["extensionList.updateFromTer.lastUpdate.timeOfLastUpdate"]+a.lastUpdateTime),a.updated&&(t=!0,window.location.replace(window.location.href))}),(async e=>{const a=e.response.statusText+"("+e.response.status+"): "+await e.response.text();Notification.warning(TYPO3.lang["extensionList.updateFromTerFlashMessage.title"],a,10)})).finally((()=>{NProgress.done(),t||($(ExtensionManagerUpdateIdentifier.splashscreen).removeClass("extensionmanager-is-shown"),$(ExtensionManagerUpdateIdentifier.terTableWrapper).removeClass("extensionmanager-is-loading"),$(ExtensionManagerUpdateIdentifier.pagination).removeClass("extensionmanager-is-loading"),$(ExtensionManagerUpdateIdentifier.terUpdateAction).removeClass("extensionmanager-is-hidden"),$(ExtensionManagerUpdateIdentifier.extensionTable).show())}))}}export default ExtensionManagerUpdate;