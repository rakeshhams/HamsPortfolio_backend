<?php


use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\GoingGreenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommonController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\NewsAndEventController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BusinessOverviewController;
use App\Http\Controllers\Api\ComplianceController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\StoriesController;


use App\Models\User;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




//auth and open api
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/client-login', [AuthController::class, 'clientLogin']);
// Route::post('/auth/client-register', [AuthController::class, 'createUser']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('/main-menu-list', [CommonController::class, 'mainMenuList']);
        Route::post('/save-or-update-main-menu', [CommonController::class, 'saveOrUpdateMainMenu']);
        Route::delete('/delete-main-menu/{id}', [CommonController::class, 'deleteMainMenu']);
        Route::get('/sub-menu-list/{id}', [CommonController::class, 'subMenuList']);
        Route::post('/save-or-update-sub-menu', [CommonController::class, 'subMenuCreateOrUpdate']);
        Route::delete('/delete-sub-menu/{id}', [CommonController::class, 'deleteSubMenu']);
        Route::get('/menu-section-list/{id}', [CommonController::class, 'menuSectionList']);
        Route::post('/save-or-update-menu-section', [CommonController::class, 'saveOrUpdateMenuSection']);
        Route::get('/submenu-by-menu/{id}', [CommonController::class, 'subMenuByMenu']);
        Route::post('/password-change', [AuthController::class, 'passwordChange']);
        Route::post('/save-or-update-common-info', [CommonController::class, 'saveOrUpdateCommonInfo']);
        Route::get('/common-info', [CommonController::class, 'commonInfo']);
        Route::Post('/save-or-update-slider', [HomeController::class, 'saveOrUpdateSlider']);
        Route::get('/slider-list', [HomeController::class, 'sliderList']);
        Route::get('/slider-feature-section', [HomeController::class, 'sliderSectionFeature']);
        Route::post('/slider-feature-save-or-update', [HomeController::class, 'sliderSectionFeatureSaveOrUpdate']);
        Route::get('/our-service-list', [HomeController::class, 'ourServiceList']);
        Route::post('/our-service-save-or-update', [HomeController::class, 'ourServiceSaveOrUpdate']);
        Route::delete('/delete-slider/{id}', [HomeController::class, 'deleteSlider']);
        Route::get('/about-section', [HomeController::class, 'aboutSection']);
        Route::post('about-save-or-update', [HomeController::class, 'aboutSaveOrUpdate']);
        Route::get('/product-section', [HomeController::class, 'productSection']);
        Route::post('/product-section-update', [HomeController::class, 'productSectionSaveOrUpdate']);
        Route::get('/achievement-list', [HomeController::class, 'achievementList']);
        Route::post('/achievement-save-or-update', [HomeController::class, 'achievementSaveOrUpdate']);
        Route::delete('/delete-achievement/{id}', [HomeController::class, 'deleteAchievement']);
        Route::get('/virtually-section', [HomeController::class, 'virtualSection']);
        Route::post('/virtually-save-or-update', [HomeController::class, 'virtualSectionSaveOrUpdate']);
        Route::get('/client-list', [HomeController::class, 'ourClientList']);
        Route::post('/client-save-or-update', [HomeController::class, 'ourClientSaveOrUpdate']);
        Route::get('/client-product-list/{id}', [HomeController::class, 'clientProductList']);
        Route::delete('/delete-client-product/{id}', [HomeController::class, 'clientProductDelete']);
        Route::post('/client-Product-save-or-update', [HomeController::class, 'ourClientProductSaveOrUpdate']);
        Route::get('/sustainability-section', [HomeController::class, 'sustainabilitySection']);
        Route::post('/sustainability-save-or-update', [HomeController::class, 'sustainabilitySaveOrUpdate']);
        Route::get('/sustainability-feature-list', [HomeController::class, 'sustainabilityFeatureList']);
        Route::post('/sustainability-feature-save-or-update', [HomeController::class, 'sustainabilityFeatureSaveOrUpdate']);
        Route::get('certification-section', [HomeController::class, 'certificationSection']);
        Route::post('certification-Section-update', [HomeController::class, 'certificationSectionUpdate']);
        Route::get('/certification-list', [HomeController::class, 'certificationList']);
        Route::post('/certification-save-or-update', [HomeController::class, 'certificationSaveOrUpdate']);

        //about us
        Route::get('/who-we-are-section', [AboutController::class, 'whoWeAreSection']);
        Route::post('/who-we-are-section-update', [AboutController::class, 'whoWeAreSectionUpdate']);
        Route::get('/process-section', [AboutController::class, 'processSection']);
        Route::post('/process-section-update', [AboutController::class, 'processSectionUpdate']);
        Route::get('/process-section-feature-list', [AboutController::class, 'processSectionFeatureList']);
        Route::post('/process-section-feature-create-or-update', [AboutController::class, 'processSectionFeatureCreateOrUpdate']);
        Route::get('/journey-section', [AboutController::class, 'journeySection']);
        Route::post('/journey-section-update', [AboutController::class, 'journeySectionUpdate']);
        Route::get('/journey-section-timeline-list', [AboutController::class, 'journeySectionTimelineList']);
        Route::post('/journey-section-timeline-create-or-update', [AboutController::class, 'journeySectionTimelineCreateOrUpdate']);
        Route::get('/quality-section', [AboutController::class, 'qualitySection']);
        Route::post('/quality-section-update', [AboutController::class, 'qualitySectionUpdate']);
        Route::get('/quality-section-feature-list', [AboutController::class, 'qualitySectionFeatureList']);
        Route::post('/quality-section-feature-create-or-update', [AboutController::class, 'qualitySectionFeatureCreateOrUpdate']);
        Route::get('/client-section', [AboutController::class, 'clientSection']);
        Route::post('/client-section-update', [AboutController::class, 'clientSectionUpdate']);
        Route::get('/elevating-section', [AboutController::class, 'elevatingSection']);
        Route::post('/elevating-section-update', [AboutController::class, 'elevatingSectionUpdate']);
        Route::get('/elevating-section-feature-list', [AboutController::class, 'elevatingSectionFeatureList']);
        Route::post('/elevating-section-feature-create-or-update', [AboutController::class, 'elevatingSectionFeatureCreateOrUpdate']);
        Route::get('customer-support-section', [AboutController::class, 'customerSupportSection']);
        Route::post('customer-support-section-update', [AboutController::class, 'customerSupportSectionUpdate']);
        //product 

        Route::get('/product-category-list', [ProductController::class, 'productCategory']);
        Route::post('/product-category-save-or-update', [ProductController::class, 'productCategorySaveOrUpdate']);
        Route::get('/product-list/{sub_category_id}', [ProductController::class, 'productList']);
        Route::post('/product-save-or-update', [ProductController::class, 'saveOrUpdateProduct']);
        Route::get('product-details/{id}', [ProductController::class, 'productDetails']);

        Route::get('/product-sub-category-list/{category_id}', [ProductController::class, 'productSubCategory']);
        Route::post('/product-sub-category-save-or-update', [ProductController::class, 'productSubCategorySaveOrUpdate']);




        //news And event
        Route::get('/news-and-event-list', [NewsAndEventController::class, 'newsAndEventList']);
        Route::post('/news-and-event-save-or-update', [NewsAndEventController::class, 'saveOrUpdateNewsAndEvent']);
        Route::get('category-list', [NewsAndEventController::class, 'categoryList']);
        Route::post('category-save-or-update', [NewsAndEventController::class, 'saveOrUpdateCategory']);

        //Approval
        Route::post('approval', [AuthController::class, 'approval']);
        Route::get('user-list', [AuthController::class, 'userList']);

        //Business Overview 
        // Hero Section
        Route::get('business_hero-section', [BusinessOverviewController::class, 'getHeroSection']);
        Route::post('business_hero-section', [BusinessOverviewController::class, 'updateHeroSection']);

        // Dynamic Image Section Metadata
        Route::get('business-product-information-section', [BusinessOverviewController::class, 'getDynamicImageSection']);
        Route::post('business-product-information-section', [BusinessOverviewController::class, 'updateDynamicImageSection']);

        //Product Dynamic Images
        Route::get('business-product-images', [BusinessOverviewController::class, 'getDynamicImages']);
        Route::post('business-product-images', [BusinessOverviewController::class, 'createDynamicImage']);
        Route::delete('business-product-images/{id}', [BusinessOverviewController::class, 'deleteDynamicImage']);
        Route::post('business-product-images/{id}', [BusinessOverviewController::class, 'updateDynamicImage']);

        Route::get('business-materials', [BusinessOverviewController::class, 'getBusinessMaterials']); // Fetch all
        Route::post('business-materials', [BusinessOverviewController::class, 'createBusinessMaterial']); // Create
        Route::post('business-materials/{id}', [BusinessOverviewController::class, 'updateBusinessMaterial']); // Update
        Route::delete('business-materials/{id}', [BusinessOverviewController::class, 'deleteBusinessMaterial']); // Delete

        Route::get('knitting-unit', [BusinessOverviewController::class, 'getKnittingUnit']); // Fetch knitting unit
        Route::post('knitting-unit', [BusinessOverviewController::class, 'updateKnittingUnit']); // Update knitting unit

        Route::get('garment-unit', [BusinessOverviewController::class, 'getGarmentUnit']); // Fetch garment unit
        Route::post('garment-unit', [BusinessOverviewController::class, 'updateGarmentUnit']); // Update garment unit

        Route::get('sustainability-unit', [BusinessOverviewController::class, 'getSustainabilityUnit']); // Fetch sustainability unit
        Route::post('sustainability-unit', [BusinessOverviewController::class, 'updateSustainabilityUnit']); // Update sustainability unit

        Route::get('multiple-units', [BusinessOverviewController::class, 'getMultipleUnits']); // Fetch list of multiple units
        Route::post('multiple-units', [BusinessOverviewController::class, 'createMultipleUnit']); // Create a multiple unit
        Route::post('multiple-units/{id}', [BusinessOverviewController::class, 'updateMultipleUnit']); // Update a multiple unit
        Route::delete('multiple-units/{id}', [BusinessOverviewController::class, 'deleteMultipleUnit']); // Delete a multiple unit

        Route::get('dyeing-units', [BusinessOverviewController::class, 'getDyeingUnits']); // Fetch all dyeing units
        Route::post('dyeing-units', [BusinessOverviewController::class, 'createDyeingUnit']); // Create a dyeing unit
        Route::post('dyeing-units/{id}', [BusinessOverviewController::class, 'updateDyeingUnit']); // Update a dyeing unit
        Route::delete('dyeing-units/{id}', [BusinessOverviewController::class, 'deleteDyeingUnit']); // Delete a dyeing unit

        //Going Green

        Route::get('going-green/hero-section', [GoingGreenController::class, 'getHeroSection']); // Fetch Going Green Hero Section
        Route::post('going-green/hero-section', [GoingGreenController::class, 'updateHeroSection']); // Update Going Green Hero Section

        Route::get('green/environmental-impact', [GoingGreenController::class, 'getEnvironmentalImpact']); // Fetch Green Environmental Impact
        Route::post('green/environmental-impact', [GoingGreenController::class, 'updateEnvironmentalImpact']);

        Route::get('green/community', [GoingGreenController::class, 'getGreenCommunity']); // Fetch Green Community
        Route::post('green/community', [GoingGreenController::class, 'updateGreenCommunity']); // Update Green Community

        Route::get('green/innovation', [GoingGreenController::class, 'getGreenInnovation']); // Fetch Green Innovation
        Route::post('green/innovation', [GoingGreenController::class, 'updateGreenInnovation']);
        Route::get('green/conclusion', [GoingGreenController::class, 'getGreenConclusion']); // Fetch Green Conclusion
        Route::post('green/conclusion', [GoingGreenController::class, 'updateGreenConclusion']); // Update Green Conclusion

        Route::get('green/messages', [GoingGreenController::class, 'getAllGreenMessages']); // Fetch all Green Messages
        Route::post('green/messages', [GoingGreenController::class, 'createGreenMessage']); // Create Green Message
        Route::post('green/messages/{id}', [GoingGreenController::class, 'updateGreenMessage']); // Update Green Message
        Route::delete('green/messages/{id}', [GoingGreenController::class, 'deleteGreenMessage']); // Delete Green Message

        Route::get('green/responsibility', [GoingGreenController::class, 'getAllGreenResponsibilities']); // Fetch all Green Responsibilities
        Route::post('green/responsibility', [GoingGreenController::class, 'createGreenResponsibility']); // Create Green Responsibility
        Route::post('green/responsibility/{id}', [GoingGreenController::class, 'updateGreenResponsibility']); // Update Green Responsibility
        Route::delete('green/responsibility/{id}', [GoingGreenController::class, 'deleteGreenResponsibility']); // Delete Green Responsibility

        //Compliance and csr
        Route::get('compliance/common-info', [ComplianceController::class, 'getComplianceInfo']); // Fetch Compliance Info
        Route::post('compliance/common-info', [ComplianceController::class, 'updateComplianceInfo']); // Update Compliance Info

        Route::get('compliance/milestones', [ComplianceController::class, 'getAllComplianceMilestones']); // Fetch all Compliance Milestones
        Route::post('compliance/milestones', [ComplianceController::class, 'createComplianceMilestone']); // Create Compliance Milestone
        Route::post('compliance/milestones/{id}', [ComplianceController::class, 'updateComplianceMilestone']); // Update Compliance Milestone
        Route::delete('compliance/milestones/{id}', [ComplianceController::class, 'deleteComplianceMilestone']); // Delete Compliance Milestone

        Route::get('compliance/activities', [ComplianceController::class, 'getAllComplianceActivities']); // Fetch all Compliance Activities
        Route::post('compliance/activities', [ComplianceController::class, 'createComplianceActivity']); // Create Compliance Activity
        Route::post('compliance/activities/{id}', [ComplianceController::class, 'updateComplianceActivity']); // Update Compliance Activity
        Route::delete('compliance/activities/{id}', [ComplianceController::class, 'deleteComplianceActivity']); // Delete Compliance Activity

        Route::get('compliance/csr-info', [ComplianceController::class, 'getComplianceCsrInfo']); // Fetch Compliance CSR Info
        Route::post('compliance/csr-info', [ComplianceController::class, 'updateComplianceCsrInfo']); // Update Compliance CSR Info

        //Employee First
        Route::get('employee/common-info', [EmployeeController::class, 'getEmployeeCommonInfo']); // Fetch Employee Common Info
        Route::post('employee/common-info', [EmployeeController::class, 'updateEmployeeCommonInfo']); // Update Employee Common Info

        Route::get('employee/stories', [EmployeeController::class, 'getAllEmployeeStories']); // Fetch all Employee Stories
        Route::post('employee/stories', [EmployeeController::class, 'createEmployeeStory']); // Create Employee Story
        Route::post('employee/stories/{id}', [EmployeeController::class, 'updateEmployeeStory']); // Update Employee Story
        Route::delete('employee/stories/{id}', [EmployeeController::class, 'deleteEmployeeStory']); // Delete Employee Story

        Route::get('employee/feedback', action: [EmployeeController::class, 'getAllEmployeeFeedbacks']); // Fetch all Employee Feedback
        Route::post('employee/feedback', [EmployeeController::class, 'createEmployeeFeedback']); // Create Employee Feedback
        Route::post('employee/feedback/{id}', [EmployeeController::class, 'updateEmployeeFeedback']); // Update Employee Feedback
        Route::delete('employee/feedback/{id}', [EmployeeController::class, 'deleteEmployeeFeedback']); // Delete Employee Feedback

        //News and story new
        Route::get('stories/recent-posts', [StoriesController::class, 'getAllStoryRecentPosts']); // Fetch all Story Recent Posts
        Route::post('stories/recent-posts', [StoriesController::class, 'createStoryRecentPost']); // Create Story Recent Post
        Route::post('stories/recent-posts/{id}', [StoriesController::class, 'updateStoryRecentPost']); // Update Story Recent Post
        Route::delete('stories/recent-posts/{id}', [StoriesController::class, 'deleteStoryRecentPost']); // Delete Story Recent Post

        Route::get('stories/feature-posts', [StoriesController::class, 'getAllStoryFeaturePosts']); // Fetch all Story Feature Posts
        Route::post('stories/feature-posts', [StoriesController::class, 'createStoryFeaturePost']); // Create Story Feature Post
        Route::post('stories/feature-posts/{id}', [StoriesController::class, 'updateStoryFeaturePost']); // Update Story Feature Post
        Route::delete('stories/feature-posts/{id}', [StoriesController::class, 'deleteStoryFeaturePost']); // Delete Story Feature Post
    });
});

Route::prefix('client')->group(function () {
    Route::get('/main-menu-list', [CommonController::class, 'mainMenuList']);
    Route::get('/common-info', [CommonController::class, 'commonInfo']);
    Route::get('home-page', [HomeController::class, 'homePage']);
    Route::get('home-service-by-submenu-id/{id}', [HomeController::class, 'homeServiceBySubmenuId']);
    Route::get('about-page', [AboutController::class, 'aboutPage']);
    Route::get('product-by-client-id/{id}', [AboutController::class, 'productByClientId']);
    Route::get('/client-product-list/{id}', [HomeController::class, 'clientProductList']);


    Route::get('product-category-list', [ProductController::class, 'productCategory']);
    Route::get('product-sub-category-list/{category_id}', [ProductController::class, 'productSubCategoryClient']);
    Route::get('product-list-by-sub-category-id/{sub_category_id}', [ProductController::class, 'productListSubCategoryClient']);

    Route::get('product-by-category-id/{id}', [ProductController::class, 'productByCategoryId']);

    Route::get('product-details/{id}', [ProductController::class, 'productDetails']);
    Route::get('certification-list', [CommonController::class, 'certificationList']);
    Route::get('news-and-event-page', [NewsAndEventController::class, 'newsAndEventPage']);
    Route::get('news-details/{id}', [NewsAndEventController::class, 'newsDetailsPage']);
    Route::get('recent-post', [NewsAndEventController::class, 'recentPost']);
    Route::get('section-and-submenu-by-menu-id/{id}', [CommonController::class, 'sectionAndSubMenuByMenuId']);
    Route::post('subscription', [CommonController::class, 'subscription']);
    // Route::get('business-sections', [BusinessOverviewController::class, 'index']);

    //Our Business
    Route::get('business_hero-section', [BusinessOverviewController::class, 'getHeroSection']);
    Route::get('business-product-information-section', [BusinessOverviewController::class, 'getDynamicImageSection']);
    Route::get('business-product-images', [BusinessOverviewController::class, 'getDynamicImages']);
    Route::get('business-materials', [BusinessOverviewController::class, 'getBusinessMaterials']);
    Route::get('knitting-unit', [BusinessOverviewController::class, 'getKnittingUnit']); // Fetch knitting unit
    Route::get('garment-unit', [BusinessOverviewController::class, 'getGarmentUnit']); // Fetch garment unit
    Route::get('sustainability-unit', [BusinessOverviewController::class, 'getSustainabilityUnit']); // Fetch sustainability unit
    Route::get('multiple-units', [BusinessOverviewController::class, 'getMultipleUnits']); // Fetch list of multiple units
    Route::get('dyeing-units', [BusinessOverviewController::class, 'getDyeingUnits']); // Fetch all dyeing 

    Route::get('going-green/hero-section', [GoingGreenController::class, 'getHeroSection']); // Fetch Going Green Hero Section
    Route::get('green/environmental-impact', [GoingGreenController::class, 'getEnvironmentalImpact']); // Fetch Green Environmental Impact

    Route::get('green/community', [GoingGreenController::class, 'getGreenCommunity']); // Fetch Green Community

    Route::get('green/innovation', [GoingGreenController::class, 'getGreenInnovation']);

    Route::get('green/conclusion', [GoingGreenController::class, 'getGreenConclusion']); // Fetch Green Conclusion
    Route::get('green/messages', [GoingGreenController::class, 'getAllGreenMessages']); // Fetch all Green Messages

    Route::get('green/responsibility', [GoingGreenController::class, 'getAllGreenResponsibilities']); // Fetch all Green Responsibilities
    Route::get('compliance/common-info', [ComplianceController::class, 'getComplianceInfo']); // Fetch Compliance Info
    Route::get('compliance/milestones', [ComplianceController::class, 'getAllComplianceMilestones']); // Fetch all Compliance Milestones
    Route::get('compliance/activities', [ComplianceController::class, 'getAllComplianceActivities']); // Fetch all Compliance Activities

    Route::get('compliance/csr-info', [ComplianceController::class, 'getComplianceCsrInfo']); // Fetch Compliance CSR Info

    Route::get('employee/common-info', [EmployeeController::class, 'getEmployeeCommonInfo']); // Fetch Employee Common Info

    Route::get('employee/stories', [EmployeeController::class, 'getAllEmployeeStories']); // Fetch all Employee Stories

    Route::get('employee/feedback', action: [EmployeeController::class, 'getAllEmployeeFeedbacks']); // Fetch all Employee Feedback

    Route::get('stories/recent-posts', [StoriesController::class, 'getAllStoryRecentPosts']); // Fetch all Story Recent Posts
    Route::get('stories/feature-posts', [StoriesController::class, 'getAllStoryFeaturePosts']); // Fetch all Story Feature Posts


});

// test route

Route::any('/test', function (Request $request) {
    return response()->json([
        'status' => true,
        'message' => 'This is test route',
        'data' => []
    ], 200);
});



Route::any('{url}', function () {
    ;
    return response()->json([
        'status' => false,
        'message' => 'Route Not Found! Please Check Your URL',
        'data' => []
    ], 404);
})->where('url', '.*');
