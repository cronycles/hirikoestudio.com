import PageProjects from "./projects";
import PageAuthLogin from "./auth/login";
import PageAuthIndex from "./auth";
import PageAuthRegister from "./auth/register";
import PageAuthForgotPassword from "./auth/forgot.password";
import PageAuthResetPassword from "./auth/reset.password";
import PageContact from "./contact";
import PageAuthCategoryCreate from "./auth/categories/auth.category.create";
import PageAuthCategoryEdit from "./auth/categories/auth.category.edit";
import PageAuthCategoriesSort from "./auth/categories/auth.categories.sort";
import PageAuthProjectCreate from "./auth/projects/auth.project.create";
import PageAuthProjectEdit from "./auth/projects/auth.project.edit";
import PageAuthProjectsSort from "./auth/projects/auth.projects.sort";
import PageAuthProjectImages from "./auth/projects/auth.project.images";

export default class PageFactory {
    constructor() {
        this.pages = [
            {id: 2, className: PageProjects},
            {id: 4, className: PageContact},
            {id: 1001, className: PageAuthLogin},
            {id: 1002, className: PageAuthRegister},
            {id: 1003, className: PageAuthForgotPassword},
            {id: 1004, className: PageAuthResetPassword},
            {id: 1010, className: PageAuthIndex},
            {id: 1012, className: PageAuthCategoryCreate},
            {id: 1013, className: PageAuthCategoryEdit},
            {id: 1014, className: PageAuthCategoriesSort},
            {id: 1016, className: PageAuthProjectCreate},
            {id: 1017, className: PageAuthProjectEdit},
            {id: 1018, className: PageAuthProjectsSort},
            {id: 1019, className: PageAuthProjectImages}
        ]
    }

    bindCurrentPageModule() {
        try {
            const currentPageId = this.#getCurrentPageId();

            if (currentPageId) {
                this.pages.map(page => {
                    if (page && page.id == currentPageId) {
                        const pageClassName = page.className;
                        new pageClassName();
                    }
                })
            }
            else {
                log.error("currentPageName not found");
            }
        } catch (e) {
            log.error(e);
        }

    }

    #getCurrentPageId = () => {
        let outcome = null;
        const $page = $(".jpage");
        if ($page) {
            outcome = $page.data('p');
        }
        return outcome;
    };

}
