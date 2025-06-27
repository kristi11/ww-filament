# Configuration Guide

This guide covers the various configuration options available in WittyWorkflow, including role management, feature toggles, and customization options.

## ⚙️ Disabled Features

> [!IMPORTANT]
>
> ##### Switch the `canEdit()` function in `CRUDSettingsResource.php` to `true` or `false` to enable or disable choosing whether the admin should be able to edit content or not.

## 📝 Side Note

#### If the `canCreate()`, `canEdit()` or `canDelete()` functions return anything other than a `true` or `false` value is best not to mess with that value because that value is supposed to be that way.

WittyWorkflow uses [filament-breezy](https://filamentphp.com/plugins/jeffgreco-breezy) to
manage user profiles. Change the following value to `shouldRegisterUserMenu: true/false` depending on your app's needs,
to `enable/disable` profile editing on `AdminPanelProvider.php` and `TeamPanelProvider.php` for the `Admin` and `Team member`
roles

```php
->myProfile(
    shouldRegisterUserMenu: false, // Sets the 'account' link in the panel User Menu (default = false)
    shouldRegisterNavigation: false, // Adds a main navigation item for the My Profile page (default = false)
    navigationGroup: 'Settings', // Sets the navigation group for the My Profile page (default = null)
    hasAvatars: false, // Enables the avatar upload form component (default = false)
    slug: 'profile' // Sets the slug for the profile page (default = 'my-profile')

)
->enableTwoFactorAuthentication(
    force: false, // force the user to enable 2FA before they can use the application (default = false)
)
```

## 👥 Role Configuration

WittyWorkflow used the [Shield](https://filamentphp.com/plugins/bezhansalleh-shield)
package to manage roles as stated above. In order to give permissions to manage appointments go on the `Roles` section of the dashboard, inside the `Settings` sidebar menu group and for both `team_user` and `panel_user` choose `select all` on
the `Appointment` model permissions and to give the `panel_user` view permissions on the gallery choose `view`
and `view any` under the `Gallery` model permissions. Also give the `panel_user` all permissions on the `Order` model permissions.

## 🔑 Role Explanation

#### In order to use the Team role you need to create the role from the admin panel and the name of the role should be 'team_user' as it doesn't exist by default and then assign that role to a desired user. Multiple roles can be assigned to a user

- `super_admin` = The super admin of the system
- `team_user` = The team members of the system assigned by the Super Admin
- `panel_user` = The panel for the customers

## 🔄 Panel Switching

> [!NOTE]
>
> In order to properly switch user panels for different roles the admin of the system must be assigned all the available roles (`super_admin`, `team_user` and `panel_user`) in the user resource. That way the admin will not be prompted with a `403` code when trying to access a panel that he doesn't have access to.

## 🔄 Adding Variants

**There are quite a few steps you need to take to add/edit/delete variants, and I'll walk you through all of them:**

- Create migration to `add/edit/delete` database variants.
- Update the `ProductVariant.php` factory if needed. As of now only the `size` and `color` variants are assigned on the initial database seed just to keep things simple.
- Add the`Enum` for the newly created variant in `App/Enums`. To keep things simple, the enum can be named the same name as the database column, but you can name it whatever you want.
- Update the `getForm()` function in `ProductVariant.php` model, add/edit/delete the desired variants.
- Update the `$table` function in `ProductVariantResource.php`, add/edit/delete the desired variants.
- Update the `$table` function in `VariationsRelationManager.php`, add/edit/delete the desired variants.
- Add/Update/Delete the newly created Enum name inside `config/enums.php`.
- Update '$casts' on the `ProductVariant.php` model

**If the above steps have been implemented, your newly created variant is ready for use throughout the app.**

> [!NOTE]
>
> **The App comes preloaded with some general variants and some tech variants. You should add the variant types that fit the type of store you're building.**

## 🔐 One Time Passwords (OTP)

> [!Important]
>
> OTP is now available for an extra added layer of security. To enable OTP just go to your desired panels and uncomment `//FilamentOtpLoginPlugin::make(),`. The available panels are `AdminPanelProvider.php`, `CustomerPanelProvider.php` and `TeamPanelProvider.php`. If you're going to enable OTP is advisable to enable it on all panels but that depends on your app's needs.

[Back to Top](../../README.md)

---

Last Updated: June 2025
