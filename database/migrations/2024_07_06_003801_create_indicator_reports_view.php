<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \DB::statement("
        CREATE OR REPLACE VIEW indicator_reports_view AS
    SELECT
        I.id AS indicatorReportID,
        I.IID,
        I.RID,
        I.Entity,
        I.ReportedBy,
        I.Response,
        I.Comments,
        I.IndicatorResponsePercentageScore,
        I.created_at AS indicatorReportCreatedAt,
        I.updated_at AS indicatorReportUpdatedAt,
        I.ApprovalStatus,
        I.ResponseType,
        I.ReasonForReturningTheIndicator,
        P.id AS projectIndicatorID,
        P.IndicatorPrimaryCategory,
        P.IndicatorSecondaryCategory,
        P.Entity AS projectIndicatorEntity,
        P.IID AS projectIndicatorIID,
        P.Indicator,
        P.ReportingToolResponses,
        P.RemarksComments,
        P.SourceOfData,
        P.ReportingRequirements,
        P.ResponseType AS projectIndicatorResponseType,
        P.created_at AS projectIndicatorCreatedAt,
        P.updated_at AS projectIndicatorUpdatedAt,
        P.ReportingPeriod,
        T.id AS reportingTimelineID,
        T.RID AS reportingTimelineRID,
        T.ReportTitle,
        T.ReportingStartDate,
        T.ReportingStartEnd,
        T.ReportType,
        T.ReportDescription,
        T.created_at AS reportingTimelineCreatedAt,
        T.updated_at AS reportingTimelineUpdatedAt,
        T.ReportingYear,
        T.ReportingQuarter
    FROM
        indicator_reports AS I
    JOIN
        project_indicators AS P ON P.IID = I.IID
    JOIN
        reporting_time_lines AS T ON I.RID = T.RID
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicator_reports_view');
    }
};
