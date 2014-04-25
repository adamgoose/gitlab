# Laravel API Wrapper for GitLab CE

[GitLab](http://gitlab.org) offers git repository management, code reviews, issue tracking, activity feeds and wiki’s. Enterprises install GitLab on-premise and connect it with LDAP and Active Directory servers for secure authentication and authorization. A single GitLab server can handle more than 25,000 users but it is also possible to create a high availability setup with a multiple active servers.

This Laravel API Wrapper allows users to plug into their own GitLab Instance's API seamlessly and in an Eloquent-like manner.

API Documentation can be viewed [here](http://adamgoose.github.io/gitlab/master/), or for the develop branch [here](http://adamgoose.github.io/gitlab/develop/).

- [Installation](#installation)
- [Namespacing & Aliases](#namespacing)
- [Usage](#usage)
- [GitLab CE API](#api)
- [Todo](#todo)

<a name="installation"></a>
## Installation

Add `adamgoose/gitlab` to your `composer.json` file.

    "require": {
        "laravel/framework": "4.1.*",
        ...
        "adamgoose/gitlab": "dev-master"
    },

Next, register the `GitlabServiceProvider` in `app/config/app.php`'s `providers` array:

    'providers' => array(
      ...
      'Adamgoose\Gitlab\GitlabServiceProvider',
    ),

Finally, you'll need to configure the API Wrapper to access your instance. Just run the following command, then update the file found at `app/config/packages/adamgoose/gitlab/config.php`.

    php artisan config:publish adamgoose/gitlab

Detailed information about the config settings can be found in the config file's comments.

<a name="namespacing"></a>
## Namespacing & Aliases

Since the API Wrapper uses an Eloquent Model-like synax, it may be useful to access some of the classes statically from the root namespace. Because of this, we have aliased all of the classes according to the default settings in the config file. You are free to change these however you wish, but use caution with common model names, such as `User`, to avoid conflict with your Eloquent models.

As of now, the config file is the only source of these aliases. Thus, any classes or models that are added to the package in the future will not be aliased automatically. I will do my best to make reference to any updates that should be made to this array in the changelog.

<a name="usage"></a>
## Usage

Traversing through the API is quite simple. Eloquent users (which should be all of you!) should be quite familiar with this type of syntax.

Since the majority of the API is centered around Projects, most of your API calls will be originated from the Project model. To find a project, simply use the `find($id)` method on the `Project` model.

    $project = Gitlab\Project::find(1);

> *Note:* This documentation will use the default model aliases configured in the config file. However, if you have updated any of these aliases, you'll need to adjust the examples accordingly. See the [Namespacing & Aliases](#namespacing) section of this document.

Casting the Project model to a string (or echoing it) will return a JSON object of all of the information provided by the [GitLab CE API](#api). 

From here, you can also obtain several of the relations associated with a Project.

    $events         = $project->events;
    $members        = $project->members;
    $hooks          = $project->hooks;
    $branches       = $project->branches;
    $tags           = $project->tags;
    $tree           = $project->tree;
    $commits        = $project->commits;
    $snippets       = $project->snippets;
    $keys           = $project->keys;
    $issues         = $project->issues;
    $milestones     = $project->milestones;
    $merge_requests = $project->merge_requests;

Each of these particular calls will return instances of [`Illuminate\Support\Collection`](https://github.com/laravel/framework/blob/4.1/src/Illuminate/Support/Collection.php) populated with te respective models.

> *Note:* If you feel the urge to call these as methods, by all means. i.e. `$project->events()`.

Many of these models are available for a single-fetch.

    $member        = $project->member($id);
    $hook          = $project->hook($id);
    $branch        = $project->branch($name);
    $commit        = $project->commit($sha);
    $snippet       = $project->snippet($id);
    $key           = $project->key($id);
    $issue         = $project->issue($id); // Note that the $id passed to the issue() method is the global ID, not the project-specific ID that is presented to you in the web version
    $milestone     = $project->milestone($id);
    $merge_request = $project->merge_request($id);

These calls will return instances of the respective models.

More documentation about each of these models will be availble in the Wiki of this repository (eventually).

<a name="api"></a>
## GitLab CE API

The GitLab API documentation can be dound at [http://doc.gitlab.com/ce/api/README.html](http://doc.gitlab.com/ce/api/README.html), or by browsing to `/help/api/README` on your personal GitLab instance.

<a name="todo"></a>
## Todo (before 1.0)

> This list is NOT prioritized.

- Enable recursive tree browsing
- Enable file downloads
- Enable archive downloads
- Create
- Update
- Delete
- Render API Documentation
- Add Exceptions
- Tests?