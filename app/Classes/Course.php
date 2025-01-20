<?php

namespace App\Classes;

use App\Classes\Interfaces\CourseManagment;
use App\Config\Database;
use Exception;

class Course
{
    private ?int $id = null;
    private string $title;
    private string $description;
    private string $type;
    private string $content;
    private int $categoryId;
    private string $creationDate;
    private ?string $coverImage;
    private int $teacherId;
    private array $tags = [];

    public function __construct(string $title, string $description, string $type, string $content, string $category, array $tags, int $teacherId, ?string $coverImage, string $date = '', int $id = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->type = $type;
        $this->content = $content;
        $this->categoryId = $category;
        $this->tags = $tags;
        $this->creationDate = $date;
        $this->coverImage = $coverImage;
        $this->teacherId = $teacherId;
        $this->id = $id;
    }


    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getType() : string 
    {
        return $this->type;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getImage() : ?string
    {
        return $this->coverImage;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeacherId(): ?int
    {
        return $this->teacherId;
    }

    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    public function create(CourseManagment $courseCreator): bool
    {
        if ($this->id === null) {
            return $courseCreator->createCourse($this);
        }

        return false;
    }

    public function update(): bool
    {
        if ($this->id === null) {
            throw new \Exception("Id cannot be null for updating");
        }

        try {
            $data = [
                'title' => $this->getTitle(),
                'description' => $this->getDescription(),
                'content' => $this->getContent(),
                'categoryId' => $this->getCategoryId(),
                'teacherId' => $this->getTeacherId()
            ];

            $result = BaseModel::updateRecord('courses', $data, $this->id);

            if ($this->getTags()) {
                BaseModel::deleteRecord('courseTags', $this->id);
                foreach ($this->getTags() as $tag) {
                    if ($tag) {
                        BaseModel::insertRecord('courseTags', ['courseId' => $this->id, 'tagId' => $tag]);
                    }
                }
            }

            return $result;
        } catch (\Exception $e) {
            error_log("Error updating course: " . $e->getMessage());
            return false;
        }
    }

    public function delete(): bool
    {
        if ($this->id === null) {
            throw new \Exception("Id cannot be null for deleting");
        }

        try {
            return BaseModel::deleteRecord('courses', $this->id);
        } catch (\Exception $e) {
            error_log("Error deleting item: " . $e->getMessage());
            return false;
        }
    }

    public static function getCourseById(int $id): ?Course
    {
        $where = "id = ?";
        $result = BaseModel::selectRecords('courses', '*', $where, [$id]);

        if ($result) {

            $courseData = $result[0];

            $tags = BaseModel::selectRecords('courseTags', 'tagId', 'courseId = ?', [$id]);
            $tagIds = [];
            foreach ($tags as $tag) {
                $tagIds[] = $tag['tagId'];
            }

            return new Course($courseData['title'], $courseData['description'], $courseData['type'], $courseData['content'], $courseData['categoryId'], $tagIds, $courseData['teacherId'], $courseData['creationDate'], $courseData['id']);
        }

        return null;
    }

    public static function getAllCourses(): array
    {
        return BaseModel::selectRecords('courses');
    }

    public static function getCourseTags(int $courseid): array
    {
        $where = "courseId = ?";
        return BaseModel::selectRecords('coursetags', 'tagId', $where, [$courseid]) ?: [];
    }

    public static function getLimitCourses(int $limit, int $offset): array|bool
    {
        $query = "SELECT * FROM courses WHERE status = 'published' LIMIT :limit OFFSET :offset;";
        $stmt = (Database::connect())->prepare($query);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result ?: [];
        }

        return false;
    }

    public static function getCountCourses(): int
    {
        $result = BaseModel::selectRecords('courses', 'COUNT(*) AS totalCourses');
        if(!$result) {
            throw new Exception("Cannot get count of courses");
        }

        return $result ? $result[0]['totalCourses'] : 0;
    }

    public static function getTeacherCourses(int $teacherId): array|bool
    {
        try {
            $where = "teacherId = ?";

            $result = BaseModel::selectRecords('courses', '*', $where, [$teacherId]);

            return $result ?: [];
        } catch (\PDOException $e) {
            error_log("Error fetching teacher courses: " . $e->getMessage());
            return false;
        }
    }

    public static function acceptCourse(int $id) 
    {
        return BaseModel::updateRecord('courses', ['status' => 'published'], $id);
    }

    public static function searchCourses(string $keyword) 
    {
        $keyword = "%" . $keyword . "%";
        $query = "SELECT * FROM courses WHERE title LIKE ? OR description LIKE ? OR content LIKE ?;";
        $stmt = (Database::connect())->prepare($query);
        $stmt->execute([$keyword, $keyword, $keyword]);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result ?: [];
    }
}
